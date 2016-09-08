<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_items`.
 */
class m160908_075813_create_shop_items_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('shop_items', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'price' => $this->double(),
        ]);

        $this->batchInsert('shop_items', ['title', 'price'], [
            [
                'title' => 'Товар 1',
                'price' => 10,
            ],
            [
                'title' => 'Товар 2',
                'price' => 20,
            ],
            [
                'title' => 'Товар 3',
                'price' => 30,
            ],
            [
                'title' => 'Товар 4',
                'price' => 40,
            ],
            [
                'title' => 'Товар 5',
                'price' => 50,
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('shop_items');
    }
}
