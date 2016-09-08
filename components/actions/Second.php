<?php

namespace app\components\actions;


class Second extends Base
{
    public function apply($amount)
    {
        if (array_key_exists(4, $this->items) && !array_key_exists(3, $this->items)) {
            return $amount - 20;
        }
    }
}