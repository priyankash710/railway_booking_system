<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_seat_data".
 *
 * @property int $id
 * @property int $coach_id
 * @property string $name
 *
 * @property MasterCoachData $coach
 */
class MasterSeatData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_seat_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coach_id', 'name'], 'required'],
            [['coach_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            //[['coach_id'], 'unique'],
            [['coach_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterCoachData::className(), 'targetAttribute' => ['coach_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coach_id' => 'Coach ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Coach]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoach()
    {
        return $this->hasOne(MasterCoachData::className(), ['id' => 'coach_id']);
    }
}
