<?php
/**
 * CardForm
 *
 * @package
 */


namespace app\models;


use app\components\Card;
use yii\base\Model;

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

        Card::addCardItem($this->item, $this->count);

        return true;
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