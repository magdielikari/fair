<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Menu;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode('Feria Abierta') ?></h1>
    
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

