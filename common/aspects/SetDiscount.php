<?php
namespace common\aspects;

use Yii;

class SetDiscount extends \yii\base\Behavior
{
    public $eventName = 'cart_cost';

    public function events()
    {
        $eventName = $this->eventName;
        return [
            $eventName => 'doDiscount'
        ];
    }

    public function doDiscount($event)
    {
        if(yii::$app->promocode->has()) {

            if (!yii::$app->promocode->get()->promocode->getTransactions()->all() && yii::$app->promocode->get()->promocode->type == 'cumulative') {
                $discount = 0;
            } else {
                $discount = yii::$app->promocode->get()->promocode->discount;
            }

            if (yii::$app->promocode->get()->promocode->type == 'percent' || yii::$app->promocode->get()->promocode->type == 'cumulative' || empty(yii::$app->promocode->get()->promocode->type)) {
                if($discount > 0 && $discount <= 100 && $event->cost > 0) {
                    $event->cost = $event->cost-($event->cost*$discount)/100;
                }
            } else {
                if($discount > 0 && $event->cost > 0) {
                    if  ($event->cost < $discount) {
                        $event->cost = $event->cost-($event->cost*100)/100;
                    } else {
                        $event->cost = $event->cost-$discount;
                    }
                }
            }
        }
        return $this;
    }
}