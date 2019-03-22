<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PurchaseConsultationSearch represents the model behind the search form of `common\models\PurchaseConsultation`.
 */
class ConsultationSearch extends Consultation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['con_id', 'con_pc_id', 'con_com_id','con_sc_id'], 'integer'],
            [['con_title', 'con_description', 'con_date', 'con_begin_time', 'con_end_time'], 'safe'],
            [['con_price'], 'number'],
            [['con_like'], 'boolean'],
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
        $query = Consultation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>21,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'con_id' => $this->con_id,
            'con_sc_id'=> $this->con_sc_id,
            'con_pc_id' => $this->con_pc_id,
            'con_date' => $this->con_date,
            'con_begin_time' => $this->con_begin_time,
            'con_end_time' => $this->con_end_time,
            'con_price' => $this->con_price,
            'con_like' => $this->con_like,
            'con_com_id' => $this->con_com_id,
        ]);

        $query->andFilterWhere(['ilike', 'con_title', $this->con_title])
            ->andFilterWhere(['ilike', 'con_description', $this->con_description]);

        return $dataProvider;
    }
}
