<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookingsDetailsSeach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-bookings-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'booking_id') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'age') ?>

    <?= $form->field($model, 'proof_type') ?>

    <?php // echo $form->field($model, 'identityfication_number') ?>

    <?php // echo $form->field($model, 'alloted_seat_no') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
