<?php

use \yii\helpers\Html;
use \yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $products common\models\Product[] */
?>
<h1>Your order</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-4">

        </div>
        <div class="col-xs-2">
            Price
        </div>
        <div class="col-xs-2">
            Quantity
        </div>
        <div class="col-xs-2">
            Cost
        </div>
    </div>
    <?php foreach ($products as $product):?>
    <div class="row">
        <div class="col-xs-4">
            <?= Html::encode($product->name) ?>
        </div>
        <div class="col-xs-2">
            $<?= $product->price ?>
        </div>
        <div class="col-xs-2">
            <?= $quantity = $product->getQuantity()?>
        </div>
        <div class="col-xs-2">
            $<?= $product->getCost() ?>
        </div>
    </div>
    <?php endforeach ?>
    <div class="row">
        <div class="col-xs-8">

        </div>
        <div class="col-xs-2">
            Total: $<?= $total ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?php
            /* @var $form ActiveForm */
            $form = ActiveForm::begin([
                'id' => 'order-form',
            ]) ?>
                <?= $form->field($payment, 'CardHolder')->dropDownList([ 'VISA' => 'VISA', 'MASTERCARD' => 'MASTERCARD', ], ['prompt' => 'Selecione una opcion']) ?>
                <?= $form->field($payment, 'CardHolderId') ?>
                <?= $form->field($payment, 'CardNumber') ?>
                <?= $form->field($payment, 'ExpirationDate')->widget(
                    DatePicker::className(), [
                        // inline too, not bad
                         'inline' => false, 
                         // modify template for custom rendering
                        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                        'clientOptions' => [
                            //'autoclose' => true,
                            'format' => 'mm/yyyy'
                        ]
                ]);?>
                <?= $form->field($payment, 'Description') ?>
                <?= $form->field($payment, 'CVC') ?>

            <div class="form-group row">
                <div class="col-xs-12">
                    <?= Html::submitButton('payment', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
