<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CompetenceProfile;

/**
 * CompetenceProfileSearch represents the model behind the search form of `common\models\CompetenceProfile`.
 */
class CompetenceProfileSearch extends CompetenceProfile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cp_id', 'cp_com_id', 'cp_p_id'], 'integer'],
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
        $query = CompetenceProfile::find();

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
            'cp_id' => $this->cp_id,
            'cp_com_id' => $this->cp_com_id,
            'cp_p_id' => $this->cp_p_id,
        ]);

        return $dataProvider;
    }
}
