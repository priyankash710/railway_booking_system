<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_bookings".
 *
 * @property int $id
 * @property int $user_id
 * @property string $begening
 * @property string $destination
 * @property string $status
 * @property string $type
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Users $user
 * @property UserBookingsDetails $userBookingsDetails
 */
class UserBookings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_bookings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'begening', 'destination','journey_date','status', 'type', 'no_of_persons','created_date', 'updated_date'], 'required'],
            [['user_id'], 'integer'],
            [['status', 'type'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['begening', 'destination'], 'string', 'max' => 255],
            [['no_of_persons'],'number','min'=>1,'max'=>7],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    public function personPerlimit() {
        if ($this->no_of_persons < 1) {
            $this->addError('no_of_persons', 'No of person should be atleast 1');
        }else if($this->no_of_persons > 7){
            $this->addError('no_of_persons', 'No of person should not exceed than 7.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'begening' => 'Begening',
            'destination' => 'Destination',
            'journey_date' => 'Date of Trip',
            'no_of_persons' => 'No of Persons',
            'status' => 'Status',
            'type' => 'Type',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[UserBookingsDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserBookingsDetails()
    {
        return $this->hasOne(UserBookingsDetails::className(), ['booking_id' => 'id']);
    }

    public function getStatusDropdown()
    {
        if(Yii::$app->user->identity->TYPE == 'User')
        {
            $status[] = array('color'=>'btn btn-danger','button_value'=>'Cancelled');
        }else{
             $status[] = array('color'=>'btn btn-primary','button_value'=>'Completed');
             $status[] = array('color'=>'btn btn-success','button_value'=>'Confirmed');
        }
        return $status;
    }
}
