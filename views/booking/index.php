<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserBookingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
if(!empty(Yii::$app->user->identity)){
$user_type = Yii::$app->user->identity->TYPE;
}
?>
<div class="user-bookings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($user_type == 'User'){?>
        <p>
            <?= Html::a('add', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
            [
              'label' => 'User Name',
              'attribute' => 'user_id',
              'visible' => (Yii::$app->user->identity->TYPE == 'Admin') ? true : false,
              'value' => function($data) {
                   return $data->user->FIRST_NAME.' '.$data->user->LAST_NAME;
               },
            ],
            'begening',
            'destination',
            'status',
            'type',
            'created_date',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
