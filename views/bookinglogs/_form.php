<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookingLogs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-booking-logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'booking_id')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'create_by_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
