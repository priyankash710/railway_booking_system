<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MasterSeatData */

$this->title = 'Update Master Seat Data: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Master Seat Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'coach_id' => $model->coach_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-seat-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
