<?php

namespace backend\models;
use backend\models\Student;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property int $name
 * @property string $year
 * @property int $user_id
 *
 * @property User $user
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'year', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'year'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'year' => 'Year',
            'user_id' => 'Teacher',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getYearName() {
        return $this->year . $this->name;
    }

    public static function getDepartmentById($department_id) {
        $student = new Student();
        $student_id = $student->id;
        $department_id = $student->getStudentById($student_id)->department_id;
        $subjQuery = 
            'SELECT department.id, department.user_id, CONCAT(user.first_name, , user.last_name) AS full_name
            FROM department INNER JOIN user ON department.user_id = user.id
            WHERE id ='.$department_id;
            
         $data = \Yii::$app->db->createCommand($subjQuery)->queryAll();
         return $data;
    }
    
}
