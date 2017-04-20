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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'name',
            //'slug',
            [
                'attribute' => 'img',
                'format' => 'html',
                'label' => 'Product',
                'value' => function ($dataProvider) {
                    return Html::img($dataProvider->imageSrc);
                },
            ],
            [
                'attribute' => 'img',
                'format' => 'html',
                'label' => 'Product',
                'value' => function ($data) {
                    $d = $data->store;
                    return Html::img($d->imageSrc);
                },
            ],
            'price',
            // 'pappid',
            // 'status',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            // 'category_id',
            // 'store_id',

            ['class' => 'yii\grid\ActionColumn',
             'template'=>'{buy}',
             'buttons' => [
                'buy'=> function($url,$model,$key){
                    return Html::a('Add to cart', ['cart/add', 'id' => $model->id], ['class' => 'btn btn-success']);
             }]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
