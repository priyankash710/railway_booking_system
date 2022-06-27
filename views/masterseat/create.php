<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MasterSeatData */

$this->title = 'Create Master Seat Data';
$this->params['breadcrumbs'][] = ['label' => 'Master Seat Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-seat-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'coaches' => $coaches,
    ]) ?>

</div>
