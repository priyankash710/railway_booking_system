<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookingLogs */

$this->title = 'Update User Booking Logs: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Booking Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-booking-logs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
