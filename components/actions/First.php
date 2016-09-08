<?php

namespace app\components\actions;


class First extends Base
{
    public function apply($amount)
    {
        if (array_key_exists(1, $this->items) && array_key_exists(2, $this->items)) {
            return $amount/2;
        }
    }
}