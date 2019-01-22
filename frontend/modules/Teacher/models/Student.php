<?php

namespace frontend\modules\Teacher\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $JMBG
 * @property string $address
 * @property string $phone
 * @property int $user_id
 * @property int $department_id
 *
 * @property Diary[] $diaries
 * @property User $user
 * @property Department $department
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'JMBG', 'address', 'phone', 'user_id', 'department_id'], 'required'],
            [['JMBG', 'user_id', 'department_id'], 'integer'],
            [['first_name', 'last_name', 'address', 'phone'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'JMBG' => 'JMBG',
            'address' => 'Address',
            'phone' => 'Phone',
            'user_id' => 'Parent',
            'department_id' => 'Department',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiaries()
    {
        return $this->hasMany(Diary::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
    public function getFullName() {
    
        return $this->first_name . ' ' . $this->last_name;
    }
}
