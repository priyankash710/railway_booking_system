<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookingsDetails */

$this->title = $model->booking_id;
$this->params['breadcrumbs'][] = ['label' => 'User Bookings Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-bookings-details-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'booking_id' => $model->booking_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'booking_id' => $model->booking_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'booking_id',
            'full_name',
            'age',
            'proof_type',
            'identityfication_number',
            'alloted_seat_no',
            'status',
            'created_date',
            'updated_date',
        ],
    ]) ?>

</div>
