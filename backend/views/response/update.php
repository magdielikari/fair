<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Response */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Response',
]) . $model->id1;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Responses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id1, 'url' => ['view', 'id' => $model->id1]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="response-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
