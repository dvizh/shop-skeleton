<?php
namespace common\aspects;

use Yii;

class SetCertificateDiscount extends \yii\base\Behavior
{
    public $eventName = 'element_cost_calculate';

    public function events()
    {
        $eventName = $this->eventName;
        return [
            $eventName => 'doDiscount',
            'cart_cost' => 'clearTmpVars',
        ];
    }

    public function init()
    {
        yii::$app->certificate->tmpVars = [];
        yii::$app->certificate->tmpVars['item_count'] = [];
    }

    public function clearTmpVars()
    {
        yii::$app->certificate->tmpVars = [];
        yii::$app->certificate->tmpVars['item_count'] = [];
    }

    public function doDiscount($event)
    {
        if ($code = yii::$app->certificate->getCode() && $targetModelList = yii::$app->certificate->getTargetModels()) {
            $certificate = yii::$app->certificate->getCurrent();
            foreach ($targetModelList as $targetModel) {
                if ($targetModel->target_id == 0) {
                    $sourceTarget = true;
                } else {
                    if  ($targetModel->target_model != 'dvizh\service\models\Category') {
                        $sourceTarget = $targetModel->target_id == $event->element->getModel()->id;
                    } else {
                        $sourceTarget = $targetModel->target_id == $event->element->getModel()->category_id;
                    }
                }
                if ($targetModel->target_model == $event->element->model && $sourceTarget || $targetModel->target_model == 'dvizh\service\models\Category' && $sourceTarget) {
                    if ($certificate->type == 'item') {
                        if (!isset(yii::$app->certificate->tmpVars['item_count'][$event->element->id])) {
                            yii::$app->certificate->tmpVars['item_count'][$event->element->id] = 0;
                        }
                        if ($targetModel->amount > yii::$app->certificate->tmpVars['item_count'][$event->element->id]) {
                            $event->cost = 0;
                        }
                        yii::$app->certificate->tmpVars['item_count'][$event->element->id] =
                            yii::$app->certificate->tmpVars['item_count'][$event->element->id] + 1;
                    } else {
                        $newCost = $event->cost;
                        $certificateAmount = $this->checkCertificateAmount($newCost, $targetModel, $event->element->id);
                        if ($certificateAmount > 0) {
                            if ($newCost > $certificateAmount) {
                                $newCost = $newCost - $certificateAmount;
                                $event->cost = $newCost;
                            } else {
                                $event->cost = 0;
                            }
                        } else {
                            break;
                        }
                    }
                }
            }
        }
        return $this;
    }

    public function checkCertificateAmount($productCost, $certificateItem, $elementId)
    {
        if (!isset(yii::$app->certificate->tmpVars[$certificateItem->id])) {
            yii::$app->certificate->tmpVars[$certificateItem->id] = [];
        }
        $return = $certificateItem->amount - array_sum(yii::$app->certificate->tmpVars[$certificateItem->id]);
        if ($return > 0) {
            if (!isset(yii::$app->certificate->tmpVars[$certificateItem->id])) {
                yii::$app->certificate->tmpVars[$certificateItem->id] = [];
            }
            if (!isset(yii::$app->certificate->tmpVars[$certificateItem->id][$elementId])) {
                yii::$app->certificate->tmpVars[$certificateItem->id][$elementId] = 0;
            }
            yii::$app->certificate->tmpVars[$certificateItem->id][$elementId] += $productCost;
        }
        return $return;
    }
}