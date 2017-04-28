<?php
namespace common\aspects;

use dvizh\order\models\Element;
use Yii;

class OrderFilling extends \yii\base\Behavior
{
    public function events()
    {
        return [
            'create' => 'putElements'
        ];
    }

    public function putElements($event)
    {
        $order = $event->model;

        foreach(yii::$app->cart->elements as $element) {
            $elementModel = new Element;

            $elementModel->setOrderId($order->id);
            $elementModel->setAssigment($order->is_assigment);
            $elementModel->setModelName($element->getModelName());
            $elementModel->setName($element->getName());
            $elementModel->setItemId($element->getItemId());
            $elementModel->setCount($element->getCount());
            $elementModel->setBasePrice($element->getPrice(false));
            $elementModel->setPrice($element->getPrice());
            $elementModel->setOptions(json_encode($element->getOptions()));
            $elementModel->setDescription('');
            $elementModel->saveData();
        }

        $order->base_cost = 0;
        $order->cost = 0;

        foreach($order->elements as $element) {
            $order->base_cost += ($element->base_price*$element->count);
            $order->cost += ($element->price*$element->count);
        }
        $order->save();

        yii::$app->cart->truncate();
    }
}