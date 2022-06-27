<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookingLogs */

$this->title = 'Create User Booking Logs';
$this->params['breadcrumbs'][] = ['label' => 'User Booking Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-booking-logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
