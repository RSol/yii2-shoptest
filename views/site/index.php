<?php

use \yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
use \yii\helpers\ArrayHelper;
use \app\models\Items;
use \app\assets\CardAsset;

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
                    <div class="col-lg-4 col-md-4">
                        <?= $form->field($model, 'item')
                            ->dropDownList(ArrayHelper::map(Items::itemList(), 'id', 'title'),
                                [
                                    'prompt' => 'Выберите товар',
                                ]) ?>
                    </div>

                    <div class="col-lg-4 col-md-4">
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
