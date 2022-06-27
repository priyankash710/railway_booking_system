<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookingsDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-bookings-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'booking_id')->textInput() ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proof_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identityfication_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alloted_seat_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'cancelled' => 'Cancelled', 'confirmed' => 'Confirmed', 'completed' => 'Completed', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
