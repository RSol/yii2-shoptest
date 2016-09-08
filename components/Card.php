<?php

namespace app\components;


use yii\helpers\Json;

class Card
{

    private static $key = 'userCard';

    /**
     * Card content
     * @return array [itemId => count]
     */
    public static function getCard()
    {
        $session = \Yii::$app->session;
        return Json::decode($session->get(static::$key, '{}'));
    }

    /**
     * @param $id integer itemId
     * @param $count integer
     */
    public static function addCardItem($id, $count)
    {
        $card = static::getCard();
        if (array_key_exists($id, $card)) {
            $card[$id] += $count;
        } else {
            $card[$id] = $count;
        }

        $key = 'userCard';
        $session = \Yii::$app->session;
        $session->set($key, Json::encode($card));
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

            $session = \Yii::$app->session;
            $session->set(static::$key, Json::encode($card));
        }
    }
}