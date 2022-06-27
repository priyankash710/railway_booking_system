<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookingsDetails */

$this->title = 'Update User Bookings Details: ' . $model->booking_id;
$this->params['breadcrumbs'][] = ['label' => 'User Bookings Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->booking_id, 'url' => ['view', 'booking_id' => $model->booking_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-bookings-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
