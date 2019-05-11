<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Competence;

/**
 * CompetenceSearch represents the model behind the search form of `backend\models\CompetencePController`.
 */
class CompetenceSearch extends Competence
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['com_id'], 'integer'],
            [['competence'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Competence::find();

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
            'com_id' => $this->com_id,
        ]);

        $query->andFilterWhere(['ilike', 'competence', $this->competence]);

        return $dataProvider;
    }
}
