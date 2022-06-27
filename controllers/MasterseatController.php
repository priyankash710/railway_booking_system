<?php

namespace app\controllers;

use app\models\MasterCoachData;
use app\models\MasterSeatData;
use app\models\MasterSeatDataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterseatController implements the CRUD actions for MasterSeatData model.
 */
class MasterseatController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all MasterSeatData models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MasterSeatDataSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MasterSeatData model.
     * @param int $coach_id Coach ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($coach_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($coach_id),
        ]);
    }

    /**
     * Creates a new MasterSeatData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MasterSeatData();
        $coaches = MasterCoachData::find()->all();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'coach_id' => $model->coach_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'coaches' => $coaches,
        ]);
    }

    /**
     * Updates an existing MasterSeatData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $coach_id Coach ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($coach_id)
    {
        $model = $this->findModel($coach_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'coach_id' => $model->coach_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MasterSeatData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $coach_id Coach ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($coach_id)
    {
        $this->findModel($coach_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MasterSeatData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $coach_id Coach ID
     * @return MasterSeatData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($coach_id)
    {
        if (($model = MasterSeatData::findOne(['coach_id' => $coach_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
