<?php


namespace app\widgets;


use app\models\CardForm;
use app\models\Items;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class CardWidget extends Widget
{
    public function run()
    {
        $items = CardForm::getCard();
        $dataProvider = new ActiveDataProvider([
            'query' => Items::find()->where(['in', 'id', array_keys($items)])->orderBy('title'),
            'pagination' => [
                'pageSize' => false,
            ],
        ]);
        return $this->render('card', [
            'items' => $items,
            'dataProvider' => $dataProvider,
        ]);
    }
}