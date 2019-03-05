<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SellingConsultation;

/**
 * SellingConsultationSearch represents the model behind the search form of `common\models\SellingConsultation`.
 */
class SellingConsultationSearch extends SellingConsultation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sc_id', 'sc_user_id', 'sc_com_id'], 'integer'],
            [['sc_title', 'sc_description', 'sc_date', 'sc_begin_time', 'sc_end_time'], 'safe'],
            [['sc_price'], 'number'],
            [['sc_like'], 'boolean'],
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
        $query = SellingConsultation::find();

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
            'sc_user_id' => $this->sc_user_id,
            'sc_date' => $this->sc_date,
            'sc_begin_time' => $this->sc_begin_time,
            'sc_end_time' => $this->sc_end_time,
            'sc_price' => $this->sc_price,
            'sc_like' => $this->sc_like,
            'sc_com_id' => $this->sc_com_id,
        ]);

        $query->andFilterWhere(['ilike', 'sc_title', $this->sc_title])
            ->andFilterWhere(['ilike', 'sc_description', $this->sc_description]);

        return $dataProvider;
    }
}
