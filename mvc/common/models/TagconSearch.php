<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * SellingConsultationSearch represents the model behind the search form of `common\models\SellingConsultation`.
 */
class TagconSearch extends TagsConsultation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tc_pc_id', 'tc_sc_id', 'tc_tag_id'], 'integer'],
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
        $query = TagsConsultation::find();
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
            'tc_pc_id'=>$this->tc_pc_id,
            'tc_sc_id'=>$this->tc_sc_id,


        ]);

        $query->andFilterWhere(['ilike', 'sc_title', $this->sc_title])
            ->andFilterWhere(['ilike', 'sc_description', $this->sc_description]);

        return $dataProvider;
    }
}
