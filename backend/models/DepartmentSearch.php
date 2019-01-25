<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Department;

/**
 * DepartmentSearch represents the model behind the search form of `backend\models\Department`.
 */
class DepartmentSearch extends Department
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['id', 'name', 'user_id'], 'integer'],
            [['id', 'name', 'user_id', 'year'], 'string'],
            [['year'], 'safe'],
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
        $query = Department::find();
        $query->leftJoin('user', 'user.id=department.user_id');
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
        ]);

        // $query->andFilterWhere(['like', 'year', $this->year]);
        //Pretrazi kolonu user_id po imenu i prezimenu ucitelja (kao kolonu user first_name i kolonu last_name)
        $query->andFilterWhere(['like', 'concat(user.first_name, " " , user.last_name) ', $this->user_id]);
        $query->andFilterWhere(['like', 'concat(year,name) ', $this->name]);
        return $dataProvider;
    }
}
