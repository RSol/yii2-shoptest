<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_items".
 *
 * @property integer $id
 * @property string $title
 * @property double $price
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'price' => 'Цена',
        ];
    }

    /**
     * @param string $q
     * @param int $limit
     * @return Items[]
     */
    public static function itemList($q = null, $limit = 20)
    {
        if (!$q) {
            return static::find()
                ->limit($limit)
                ->all();
        }
        return static::find()
            ->where(['like', 'title', $q])
            ->limit($limit)
            ->all();
    }
}
