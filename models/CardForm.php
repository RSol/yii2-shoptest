<?php
/**
 * CardForm
 *
 * @package
 */


namespace app\models;


use yii\base\Model;
use yii\db\Query;
use yii\helpers\Json;

class CardForm extends Model
{
    public $item;
    public $count = 1;

    public function attributeLabels()
    {
        return [
            'item' => 'Товар',
            'count' => 'Количество',
        ];
    }

    public function rules()
    {
        return [
            [['item', 'count'], 'required'],
            [['item', 'count'], 'integer', 'min' => 1],
            ['item', function ($attribute, $params) {
                if ($this->hasErrors()) {
                    return;
                }
                if (!$this->getItemModel()) {
                    $this->addError('item', 'Товар не найден');
                }
            }],
        ];
    }

    /**
     * Save card in session
     * @return bool
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $card = static::getCard();
        if (array_key_exists($this->item, $card)) {
            $card[$this->item] += $this->count;
        } else {
            $card[$this->item] = $this->count;
        }

        $key = 'userCard';
        $session = \Yii::$app->session;
        $session->set($key, Json::encode($card));

        return true;
    }

    /**
     * Delete item from card
     * @param $id
     */
    public static function deleteCardItem($id)
    {
        $card = static::getCard();
        if (array_key_exists($id, $card)) {
            unset($card[$id]);

            $key = 'userCard';
            $session = \Yii::$app->session;
            $session->set($key, Json::encode($card));
        }
    }

    /**
     * Card content
     * @return array [itemId => count]
     */
    public static function getCard()
    {
        $key = 'userCard';
        $session = \Yii::$app->session;
        return Json::decode($session->get($key, '{}'));
    }

    /**
     * @return Items
     */
    public function getItemModel()
    {
        return static::getItem($this->item);
    }

    private static $items = [];

    /**
     * @param $id
     * @return Items
     */
    private static function getItem($id)
    {
        if (array_key_exists($id, static::$items)) {
            return static::$items[$id];
        }

        return static::$items[$id] = Items::findOne($id);
    }
}