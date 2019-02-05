<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `common\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_id', 'p_user_id', 'p_id_profile_competence'], 'integer'],
            [['p_name', 'p_second_name', 'p_family', 'p_description', 'p_image', 'p_date'], 'safe'],
            [['p_gender'], 'boolean'],
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
        $query = Profile::find();

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
            'p_id' => $this->p_id,
            'p_user_id' => $this->p_user_id,
            'p_gender' => $this->p_gender,
            'p_date' => $this->p_date,
            'p_id_profile_competence' => $this->p_id_profile_competence,
        ]);

        $query->andFilterWhere(['ilike', 'p_name', $this->p_name])
            ->andFilterWhere(['ilike', 'p_second_name', $this->p_second_name])
            ->andFilterWhere(['ilike', 'p_family', $this->p_family])
            ->andFilterWhere(['ilike', 'p_description', $this->p_description])
            ->andFilterWhere(['ilike', 'p_image', $this->p_image]);

        return $dataProvider;
    }
}
