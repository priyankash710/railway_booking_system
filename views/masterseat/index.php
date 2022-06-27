<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MasterSeatDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Seat Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-seat-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Master Seat Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'coach_id',
            'name',
        ],
    ]); ?>


</div>
