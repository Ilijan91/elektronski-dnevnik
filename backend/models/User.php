<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $roll_id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Roll $roll
 */
class User extends \common\models\User
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['roll_id', 'first_name', 'last_name', 'JMBG', 'username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['roll_id', 'status', 'JMBG', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['JMBG'], 'unique',],
            [['JMBG'], 'integer', 'min' => 13],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['roll_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roll::className(), 'targetAttribute' => ['roll_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'roll_id' => 'Roll ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'JMBG' => 'JMBG',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoll()
    {
        return $this->hasOne(Roll::className(), ['id' => 'roll_id']);
    }
}
