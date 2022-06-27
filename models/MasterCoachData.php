<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_coach_data".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 *
 * @property MasterSeatData $masterSeatData
 */
class MasterCoachData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_coach_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[MasterSeatData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMasterSeatData()
    {
        return $this->hasOne(MasterSeatData::className(), ['coach_id' => 'id']);
    }
}
