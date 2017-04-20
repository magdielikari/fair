<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category_detail">
    <?= 
    foreach ($cModel as $key => $value) {
        DetailView::widget([
            'model' => $key,
            'attributes' => [
                'name',
            ],
        ])
    }
     ?>

</div>
