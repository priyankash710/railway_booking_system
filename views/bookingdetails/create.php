<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookingsDetails */

$this->title = 'Create User Bookings Details';
$this->params['breadcrumbs'][] = ['label' => 'User Bookings Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bookings-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
