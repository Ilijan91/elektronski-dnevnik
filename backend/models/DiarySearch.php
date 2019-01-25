<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Diary;

/**
 * DiarySearch represents the model behind the search form of `backend\models\Diary`.
 */
class DiarySearch extends Diary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['id', 'final_grade'], 'integer'],
            [[ 'student_id', 'subject_id', 'grade_id',], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Diary::find();
        //Prilikom pretrage tabele diary dodaj tabele student, subject i grade
        $query->leftJoin('student', 'student.id=diary.student_id');
        $query->leftJoin('subject', 'subject.id=diary.subject_id');
        $query->leftJoin('grade', 'grade.id=diary.grade_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'final_grade' => $this->final_grade,
        ]);
        //Pretrazi kolonu subject_id po nazivima predmeta (kao kolonu subject title)
        $query->andFilterWhere(['like', 'subject.title',$this->subject_id ]);
        //Pretrazi kolonu grade_id po ocenama (kao kolonu grade title)
        $query->andFilterWhere(['like', 'grade.title',$this->grade_id ]);
        //Pretrazi kolonu student_id po imenu i prezimenu ucenika (kao kolonu subject first_name i kolonu last_name)
        $query->andFilterWhere(['like', 'concat(student.first_name, " " , student.last_name) ', $this->student_id]);

        return $dataProvider;
    }
}
