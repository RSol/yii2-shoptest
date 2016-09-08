<?php


namespace app\widgets;


use app\components\actions\Action;
use app\models\CardForm;
use app\models\Items;
use yii\base\Widget;

class PriceWidget extends Widget
{
    /**
     * @var array [itemId => count]
     */
    public $items;

    /**
     * @var Items[]
     */
    public $models;

    public function init()
    {
        if (!$this->items) {
            $this->items = CardForm::getCard();
        }

        if (!$this->models) {
            $this->models = Items::find()
                ->select('id, price')
                ->where(['in', 'id', array_keys($this->items)])
                ->all();
        }
    }

    public function run()
    {
        $sum = 0;
        foreach ($this->models as $model) {
            if (array_key_exists($model->id, $this->items)) {
                $sum += ($this->items[$model->id] * $model->price);
            }
        }

        /**
         * @var $actions Action
         */
        $actions = \Yii::$app->actions;
        $result = $actions->apply($sum, $this->items, $this->models);

        return $this->render('price', $result);
    }
}