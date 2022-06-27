<?php

namespace app\controllers;
use yii;
use yii\helpers\Url;
use app\models\UserBookingsDetails;
use app\models\UserBookingLogs;
use app\models\UserBookings;
use app\models\UserBookingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * BookingController implements the CRUD actions for UserBookings model.
 */
class BookingController extends Controller
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
     * Lists all UserBookings models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error',"Unauthorised access. Please login first.");
                return $this->redirect(Url::toRoute('site/login'));
            }
            else {
            /*$searchModel = new UserBookingsSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);*/
            if(Yii::$app->user->identity->TYPE == 'User')
            {
                $user_id = Yii::$app->user->identity->id;
                $query = UserBookings::find()->where(['user_id' => $user_id]);

            }else{
                $query = UserBookings::find();
            }
            $provider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ]
                ],
            ]);

            return $this->render('index', [
                //'searchModel' => $searchModel,
                'dataProvider' => $provider,
            ]);
        }
    }

    /**
     * Displays a single UserBookings model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error',"Unauthorised access. Please login first.");
                return $this->redirect(Url::toRoute('site/login'));
            }
            else {
                $query = UserBookingsDetails::find()->where(['booking_id'=>$id]);
                $provider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                    'sort' => [
                        'defaultOrder' => [
                            'id' => SORT_DESC,
                        ]
                    ],
                ]);
                $queryLogs = UserBookingLogs::find()->where(['booking_id'=>$id]);
                $providerLogs = new ActiveDataProvider([
                    'query' => $queryLogs,
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                    'sort' => [
                        'defaultOrder' => [
                            'id' => SORT_DESC,
                        ]
                    ],
                ]);
                return $this->render('view', [
                    'model' => $this->findModel($id),
                    'dataProvider' => $provider,
                    'dataProviderLogs' => $providerLogs,
                ]);
            }
    }

    /**
     * Creates a new UserBookings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error',"Unauthorised access. Please login first.");
                return $this->redirect(Url::toRoute('site/login'));
            }
            else {
            $model = new UserBookings();            
            $logs = new UserBookingLogs();
            if ($this->request->isPost) {
                   if ($model->load($this->request->post())) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                           //if callback returns true than commit transaction
                          $model->user_id = Yii::$app->user->identity->id;
                          $model->status = 'Pending';
                          $model->created_date = date('Y-m-d h:i:s');
                          $model->updated_date = date('Y-m-d h:i:s');
                          if($model->save())
                          {
                            if ($_POST['UserBookingsDetails']) {
                                $totalcount = sizeof($_POST['UserBookingsDetails']['full_name']);
                                for($i = 0; $i < $totalcount; $i++) {
                                  $details = new UserBookingsDetails();
                                   $details->booking_id = $model->id;
                                   $details->full_name = $_POST['UserBookingsDetails']['full_name'][$i];
                                   $details->age = $_POST['UserBookingsDetails']['age'][$i];
                                   $details->proof_type = $_POST['UserBookingsDetails']['proof_type'][$i];
                                   $details->identityfication_number = $_POST['UserBookingsDetails']['identityfication_number'][$i];
                                   $details->status = 'Pending';
                                   $details->created_date = date('Y-m-d h:i:s');
                                   $details->updated_date = date('Y-m-d h:i:s');
                                   $details->save(false);
                                }
                                $logs->booking_id = $model->id; 
                                $logs->description = 'New booking created by '.Yii::$app->user->identity->FIRST_NAME.' '.Yii::$app->user->identity->LAST_NAME; 
                                $logs->create_by_id = $model->user_id; 
                               if($logs->save())
                                {
                                    $transaction->commit();
                                    Yii::$app->session->setFlash('success','Booking added successfully');
                                    return $this->redirect(['view', 'id' => $model->id]);
                                }else{
                                    Yii::$app->session->setFlash('logs error == >','Model validate');
                                    $transaction->rollBack();
                                }
                            }else{
                                Yii::$app->session->setFlash('details error == >','Model validate');
                                $transaction->rollBack();
                            }
                          }else{
                            Yii::$app->session->setFlash('Modle error == >','Model validate');
                            $transaction->rollBack();
                          }
                       } catch (\Exception $e) {
                           $transaction->rollBack();
                           throw $e;
                       }
                       //$transaction->rollBack();
                    //return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserBookings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error',"Unauthorised access. Please login first.");
                return $this->redirect(Url::toRoute('site/login'));
            }
            else {
                $model = $this->findModel($id);

                if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                return $this->render('update', [
                    'model' => $model,
                ]);
            }
    }

    /**
     * Deletes an existing UserBookings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error',"Unauthorised access. Please login first.");
                return $this->redirect(Url::toRoute('site/login'));
            }
            else {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            }
    }

    /**
     * Finds the UserBookings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserBookings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error',"Unauthorised access. Please login first.");
                return $this->redirect(Url::toRoute('site/login'));
            }
            else {
            if (($model = UserBookings::findOne(['id' => $id])) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Updates an existing UserBookings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionStatechange($id,$status)
    {
        if(Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error',"Unauthorised access. Please login first.");
                return $this->redirect(Url::toRoute('site/login'));
            }
            else {
                $model = $this->findModel($id);
                $logs = new UserBookingLogs();
                $bookingDetails = UserBookingsDetails::find()->where(['booking_id'=>$id])->all();
                $connection = Yii::$app->getDb();
                $query = "SELECT booking.status,seat.id as seat_id, coach.name as coach_name, seat.name as seat_number from master_seat_data as seat LEFT JOIN master_coach_data as coach ON coach.id = seat.coach_id LEFT JOIN user_bookings_details as detail on detail.alloted_seat_no = seat.id LEFT JOIN user_bookings as booking ON booking.id = detail.booking_id WHERE booking.status = 'Completed' || booking.status is NULL";
                $command = $connection->createCommand($query);
                $availableSeats = $command->queryAll();
                if (!empty($_POST['UserBookingsDetails'])) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                           //if callback returns true than commit transaction
                          $model->status = $status;
                          $model->updated_date = date('Y-m-d h:i:s');
                          if($model->updateAttributes(['status','updated_date']))
                          {
                            if($status == 'Confirmed'){  
                                $totalcount = sizeof($bookingDetails);
                                for($i = 0; $i < $totalcount; $i++) {
                                   $details = UserBookingsDetails::findOne($_POST['UserBookingsDetails']['id'][$i]);
                                   $details->alloted_seat_no = $_POST['UserBookingsDetails']['alloted_seat_no'][$i];
                                   $details->status = $status;
                                   $details->updated_date = date('Y-m-d h:i:s');
                                   $details->updateAttributes(['alloted_seat_no','status','updated_date']);
                                }
                            }
                                $logs->booking_id = $model->id; 
                                $logs->description = 'Booking is '.$status.' by '.Yii::$app->user->identity->FIRST_NAME.' '.Yii::$app->user->identity->LAST_NAME; 
                                $logs->create_by_id = $model->user_id; 
                               if($logs->save())
                                {
                                    $transaction->commit();
                                    Yii::$app->session->setFlash('success',$logs->description);
                                    return $this->redirect(['view', 'id' => $model->id]);
                                }else{
                                    Yii::$app->session->setFlash('logs error == >','Model validate');
                                    $transaction->rollBack();
                                }
                            
                          }else{
                            Yii::$app->session->setFlash('Modle error == >','Model validate');
                            $transaction->rollBack();
                          }
                       } catch (\Exception $e) {
                           $transaction->rollBack();
                           throw $e;
                       }                       
                }else{
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                           //if callback returns true than commit transaction
                          $model->status = $status;
                          $model->updated_date = date('Y-m-d h:i:s');
                          if($model->updateAttributes(['status','updated_date']))
                          {
                                $logs->booking_id = $model->id; 
                                $logs->description = 'Booking is '.$status.' by '.Yii::$app->user->identity->FIRST_NAME.' '.Yii::$app->user->identity->LAST_NAME; 
                                $logs->create_by_id = $model->user_id; 
                               if($logs->save())
                                {
                                    $transaction->commit();
                                    Yii::$app->session->setFlash('success',$logs->description);
                                    return $this->redirect(['view', 'id' => $model->id]);
                                }else{
                                    Yii::$app->session->setFlash('logs error == >','Model validate');
                                    $transaction->rollBack();
                                }
                            
                          }else{
                            Yii::$app->session->setFlash('Modle error == >','Model validate');
                            $transaction->rollBack();
                          }
                       } catch (\Exception $e) {
                           $transaction->rollBack();
                           throw $e;
                       }
                }
                if($status == 'Confirmed'){
                    return $this->render('update', [
                        'model' => $model,
                        'bookingDetails' => $bookingDetails,
                        'availableSeats' => $availableSeats,
                    ]);
                }
            }
    }
}
