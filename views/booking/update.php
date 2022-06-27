<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookings */

$this->title = 'Confirmed Bookings: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-bookings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formDetails', [
        'model' => $model,
        'bookingDetails' => $bookingDetails,
        'availableSeats' => $availableSeats,
    ]) ?>

</div>
