<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MasterSeatData */
/* @var $form yii\widgets\ActiveForm */
$list=ArrayHelper::map($coaches,'id','name');
?>

<div class="master-seat-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'coach_id')->dropDownList($list,['prompt'=>'select coach']);?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
