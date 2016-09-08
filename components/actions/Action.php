<?php

namespace app\components\actions;


use app\models\Items;
use Codeception\Exception\ConfigurationException;
use yii\base\Component;

class Action extends Component
{
    /**
     * @var array list of action classes with namespaces
     */
    public $actions = [];

    /**
     * @var bool are stop after find first action
     */
    public $firstStop = true;

    /**
     * @param $amount integer
     * @param $items array [itemId => count]
     * @param $models Items[]
     * @return array
     * @throws ConfigurationException
     */
    public function apply($amount, $items, $models)
    {
        $apply = [
            'name' => [],
            'amount' => $amount,
        ];
        foreach ($this->actions as $action) {
            if (!(array_key_exists('class', $action) && class_exists($action['class']))) {
                throw new ConfigurationException('Неправильно сконфигурированы акции');
            }

            /**
             * @var $class Base;
             */
            $class = new $action['class'];
            $class->items = $items;
            $class->models = $models;

            $result = $class->apply($amount);
            if ($result) {
                $apply['name'][] = array_key_exists('name', $action)
                    ? $action['name']
                    : $action['class'];
                $amount = $apply['amount'] = $result;

                if ($this->firstStop) {
                    return $apply;
                }
            }
        }

        return $apply;
    }
}