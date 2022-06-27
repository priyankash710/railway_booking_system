<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_bookings_details".
 *
 * @property int $id
 * @property int $booking_id
 * @property string $full_name
 * @property string $age
 * @property string $proof_type
 * @property string $file_name
 * @property string $alloted_seat_no
 * @property string $status
 * @property string $created_date
 * @property string $updated_date
 *
 * @property UserBookings $booking
 */
class UserBookingsDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_bookings_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['booking_id', 'full_name', 'age', 'proof_type', 'identityfication_number', 'status', 'created_date', 'updated_date'], 'required'],
            [['id', 'booking_id'], 'integer'],
            [['status'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['full_name', 'age', 'proof_type', 'identityfication_number', 'alloted_seat_no'], 'string', 'max' => 255],
            [['booking_id'], 'unique'],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserBookings::className(), 'targetAttribute' => ['booking_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking_id' => 'Booking ID',
            'full_name' => 'Full Name',
            'age' => 'Age',
            'proof_type' => 'Proof Type',
            'identityfication_number' => 'Identityfication Number',
            'alloted_seat_no' => 'Alloted Seat No',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    /**
     * Gets query for [[Booking]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(UserBookings::className(), ['id' => 'booking_id']);
    }

    public function getSeatdetail($detail_id){
        $connection = Yii::$app->getDb();
        $query = "SELECT coach.name as coach_name, seat.name as seat_number from master_seat_data as seat LEFT JOIN master_coach_data as coach ON coach.id = seat.coach_id WHERE seat.id=".$detail_id;
        $command = $connection->createCommand($query);
        $result = $command->queryOne();
        return $result;
    }
}
