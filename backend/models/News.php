<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $image
 * @property string $created_at

 *

 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body','image'], 'required'],
            [['body'], 'string'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 256],
            [['image'], 'file' ,'extensions'=>'jpg,png,gif','maxFiles'=>3]
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'image' => 'Image',
            'created_at' => 'Created At'  
        ];
    }
}

   

