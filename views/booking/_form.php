<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-bookings-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class ="col-md-4">
        <?= $form->field($model, 'begening')->textInput(['maxlength' => true]) ?>
    </div>
    <div class ="col-md-4">
        <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>
    </div>
    <div class ="col-md-4">
        <?= $form->field($model, 'no_of_persons')->textInput(['maxlength' => true,'type'=>'number','min'=>1,'max'=>7]) ?>
    </div>
    <div class ="col-md-4">
        <?php echo $form->field($model, 'journey_date')->textInput(['maxlength' => true]) ?>
    </div>
    <div class ="col-md-4">
    <?= $form->field($model, 'type')->dropDownList([ 'Reservation' => 'Reservation', 'General' => 'General', ], ['prompt' => 'select type']) ?>
    </div>
    <div class="clearfix"></div>
    <div id="booking-details" style="display:none">
        <h3>Add User details</h3>
        <div id="user_details"></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
