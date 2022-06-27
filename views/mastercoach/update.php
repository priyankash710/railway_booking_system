<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MasterCoachData */

$this->title = 'Update Master Coach Data: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Master Coach Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-coach-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
