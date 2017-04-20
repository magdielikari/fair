<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServicesItems */

$this->title = Yii::t('app', 'Create Services Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
