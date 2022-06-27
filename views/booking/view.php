<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\UserBookings;
use app\models\UserBookingsDetails;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookings */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$status = UserBookings::getStatusDropdown();
?>
<style>
    a.btn {
        margin: 0px 10px;
    }
</style>
<div class="user-bookings-view">

    <p style="text-align: right;">
        <?php foreach ($status as $key => $value) {
            if($value['button_value'] != ucfirst($model->status)){
                echo Html::a($value['button_value'], ['statechange', 'id' => $model->id,'status'=>$value['button_value']], [
                            'class' => $value['color'],
                            'data' => [
                                'confirm' => 'Are you sure you want to '.$value['button_value'].' this booking?',
                                'method' => 'post',
                            ],
                            ]);
            }
        } ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>
    <h3>Booking Details</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'full_name',
            'age',
            'proof_type',
            'identityfication_number',
            //'alloted_seat_no',
            [
              'label' => 'seat',
              'attribute' => 'alloted_seat_no',
              'visible' => (Yii::$app->user->identity->TYPE == 'Admin') ? true : false,
              'value' => function($detail) {
                    $seatDetail = UserBookingsDetails::getSeatdetail($detail->alloted_seat_no);
                    return $seatDetail['coach_name'].'('.$seatDetail['seat_number'].')';
               },
            ],
            'status',           
        ],
    ]); ?>
     <h3>Booking Logs</h3>
     <?= GridView::widget([
         'dataProvider' => $dataProviderLogs,
         'columns' => [
             ['class' => 'yii\grid\SerialColumn'],
             'id',
             'description:ntext',             
         ],
     ]); ?>
</div>
