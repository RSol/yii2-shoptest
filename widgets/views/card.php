<?php
use yii\grid\GridView;

/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $items array [itemId => count]
 */

?>

    <h2>Корзина</h2>

<?php if (!$items): ?>
    <p>
        Ваша корзина пуста
    </p>
<?php else: ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}',
        'columns' => [
            'title',
            [
                'header' => 'Количество',
                'content' => function ($model, $key, $index, $column) use ($items) {
                    /**
                     * @var $model \app\models\Items
                     */
                    return array_key_exists($model->id, $items)
                        ? $items[$model->id]
                        : '-';
                }
            ],
            [
                'header' => 'Цена',
                'content' => function ($model, $key, $index, $column) use ($items) {
                    /**
                     * @var $model \app\models\Items
                     */
                    return array_key_exists($model->id, $items)
                        ? (($items[$model->id] * $model->price) . " у.е.")
                        : '-';
                }
            ],
            [
                'header' => '',
                'content' => function ($model, $key, $index, $column) {
                    /**
                     * @var $model \app\models\Items
                     */
                    return \yii\helpers\Html::a('Удалить из корзины', ['delete', 'id' => $model->id], [
                        'class' => 'card_delete_item',
                    ]);
                }
            ],
        ],
    ]); ?>
    <?= \app\widgets\PriceWidget::widget([
        'items' => $items,
        'models' => $dataProvider->getModels(),
    ]) ?>
<?php endif; ?>