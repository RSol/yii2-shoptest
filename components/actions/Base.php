<?php

namespace app\components\actions;


use app\models\Items;

abstract class Base
{
    /**
     * @var array [itemId => count]
     */
    public $items;

    /**
     * @var Items[]
     */
    public $models;

    /**
     * @param $amount integer
     * @return mixed
     */
    abstract public function apply($amount);
}