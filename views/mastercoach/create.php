<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MasterCoachData */

$this->title = 'Create Master Coach Data';
$this->params['breadcrumbs'][] = ['label' => 'Master Coach Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-coach-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
