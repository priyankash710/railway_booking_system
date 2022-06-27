<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_booking_logs".
 *
 * @property int $id
 * @property int $booking_id
 * @property string $description
 * @property int $create_by_id
 *
 * @property Users $createBy
 */
class UserBookingLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_booking_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['booking_id', 'description', 'create_by_id'], 'required'],
            [['booking_id', 'create_by_id'], 'integer'],
            [['description'], 'string'],
            [['create_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['create_by_id' => 'id']],
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
            'description' => 'Description',
            'create_by_id' => 'Create By ID',
        ];
    }

    /**
     * Gets query for [[CreateBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'create_by_id']);
    }
}
