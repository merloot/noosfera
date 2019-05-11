<?php

namespace common\models;

use common\models\Notifications;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CompetenceProfileSearch represents the model behind the search form of `common\models\Notification`.
 */
class NotificationSearch extends Notifications
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['n_selling_user_id', 'n_purchase_user_id', 'n_con_id','n_status'], 'integer'],
            [['n_type'],'string'],
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
        $query = Notifications::find();

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
            'n_selling_user_id' => $this->n_selling_user_id,
            'n_purchase_user_id' => $this->n_purchase_user_id,
            'n_status'=> $this->n_status,
            'n_con_id' => $this->n_con_id,
        ]);

        return $dataProvider;
    }
}
