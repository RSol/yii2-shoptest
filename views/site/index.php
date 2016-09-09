<?php

use \yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
use \app\assets\CardAsset;
use \yii\web\JsExpression;
use kartik\select2\Select2;

/**
 * @var $this yii\web\View
 * @var $model \app\models\CardForm
 */

$this->title = 'Интернет магазин!';
CardAsset::register($this);
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Интернет магазин!</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">

                <?php $form = ActiveForm::begin([
                    'id' => 'card_form',
                    'action' => ['card'],
                    'validateOnSubmit' => false,
                ]);
                ?>

                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <?= $form->field($model, 'item')
                            ->widget(Select2::classname(), [
                                'options' => ['placeholder' => 'Выберите товар'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'minimumInputLength' => 2,

                                    'ajax' => [
                                        'url' => ['list'],
                                        'dataType' => 'json',
                                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                    ],
                                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                    'templateResult' => new JsExpression('function(item) { return item.title; }'),
                                    'templateSelection' => new JsExpression('function (item) { return item.title; }'),
                                ],
                            ]) ?>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <?= $form->field($model, 'count')->textInput() ?>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label class="control-label">&nbsp;</label>
                            <?= Html::submitButton('Добавить в корзину', [
                                'class' => 'btn btn-success',
                            ]) ?>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12" id="card">
                <?= \app\widgets\CardWidget::widget() ?>
            </div>
        </div>

    </div>
</div>
