<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $FIRST_NAME
 * @property string $LAST_NAME
 * @property string $EMAIL
 * @property string $PASSWORD
 * @property string $STATUS
 * @property string $TYPE
 * @property string $CREATED_DATE
 * @property string $UPDATED_DATE
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FIRST_NAME', 'LAST_NAME', 'EMAIL','username','password', 'STATUS', 'TYPE', 'CREATED_DATE', 'UPDATED_DATE'], 'required'],
            [['EMAIL','username'], 'unique'],
            [['STATUS', 'TYPE'], 'string'],
            [['CREATED_DATE', 'UPDATED_DATE'], 'safe'],
            [['FIRST_NAME', 'LAST_NAME', 'EMAIL', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FIRST_NAME' => 'First Name',
            'LAST_NAME' => 'Last Name',
            'EMAIL' => 'Email',
            'password' => 'Password',
            'STATUS' => 'Status',
            'TYPE' => 'Type',
            'CREATED_DATE' => 'Created Date',
            'UPDATED_DATE' => 'Updated Date',
        ];
    }
}
