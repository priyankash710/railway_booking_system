<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserBookingsDetailsSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Bookings Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bookings-details-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Bookings Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'booking_id',
            'full_name',
            'age',
            'proof_type',
            //'identityfication_number',
            //'alloted_seat_no',
            //'status',
            //'created_date',
            //'updated_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UserBookingsDetails $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'booking_id' => $model->booking_id]);
                 }
            ],
        ],
    ]); ?>


</div>
