<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookings */

$this->title = 'Booking Info';
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bookings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
