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
            [['id', 'final_grade', 'student_id', 'subject_id'], 'integer'],
            [['grade'], 'safe'],
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
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
        ]);

        $query->andFilterWhere(['like', 'grade', $this->grade]);

        return $dataProvider;
    }
}
