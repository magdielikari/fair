<?php

use yii\helpers\Html;

$this->title = 'Logos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

	<?= Html::img('@web/images/logo/carpa.png', ['alt'=>Yii::$app->name]); ?>
	<?= Html::img('@web/images/logo/globos.png', ['alt'=>Yii::$app->name]); ?>
	<?= Html::img('@web/images/logo/guacamaya.png', ['alt'=>Yii::$app->name]); ?>
	<?= Html::img('@web/images/logo/guacamaya2.png', ['alt'=>Yii::$app->name]); ?>
	<?= Html::img('@web/images/logo/guacamaya3.png', ['alt'=>Yii::$app->name]); ?>
	<?= Html::img('@web/images/logo/pelota.png', ['alt'=>Yii::$app->name]); ?>
	<?= Html::img('@web/images/logo/rueda.png', ['alt'=>Yii::$app->name]); ?>
	<?= Html::img('@web/images/logo/letra1.png', ['alt'=>Yii::$app->name]); ?>
	<?= Html::img('@web/images/logo/letra2.png', ['alt'=>Yii::$app->name]); ?>

</div>
