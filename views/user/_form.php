<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php //echo $form->errorSummary($model); ?>

    <?= $form->field($model, 'FIRST_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LAST_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPE')->dropDownList([ 'Admin' => 'Admin', 'User' => 'User', ], ['prompt' => 'Select User Type']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
