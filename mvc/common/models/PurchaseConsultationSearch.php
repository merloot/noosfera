<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PurchaseConsultation;

/**
 * PurchaseConsultationSearch represents the model behind the search form of `common\models\PurchaseConsultation`.
 */
class PurchaseConsultationSearch extends PurchaseConsultation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pc_id', 'pc_user_id', 'pc_com_id'], 'integer'],
            [['pc_title', 'pc_description', 'pc_date', 'pc_begin_time', 'pc_end_time'], 'safe'],
            [['pc_price'], 'number'],
            [['pc_like'], 'boolean'],
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
        $query = PurchaseConsultation::find();

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
            'pc_id' => $this->pc_id,
            'pc_user_id' => $this->pc_user_id,
            'pc_date' => $this->pc_date,
            'pc_begin_time' => $this->pc_begin_time,
            'pc_end_time' => $this->pc_end_time,
            'pc_price' => $this->pc_price,
            'pc_like' => $this->pc_like,
            'pc_com_id' => $this->pc_com_id,
        ]);

        $query->andFilterWhere(['ilike', 'pc_title', $this->pc_title])
            ->andFilterWhere(['ilike', 'pc_description', $this->pc_description]);

        return $dataProvider;
    }
}
