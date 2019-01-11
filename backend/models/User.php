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

 * @property string $password_hash

 * @property string $email
 
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
            [['roll_id', 'first_name', 'last_name', 'username', 'password_hash', 'email'], 'required'],
            [['roll_id', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'username', 'password', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
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
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',           
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
