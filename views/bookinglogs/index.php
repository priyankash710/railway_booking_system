<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserBookingLogsSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Booking Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-booking-logs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Booking Logs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'booking_id',
            'description:ntext',
            'create_by_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UserBookingLogs $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
