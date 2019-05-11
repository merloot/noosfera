<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 02.04.19
 * Time: 10:12
 */


namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ArchiveSearch extends Archive
{


    public function rules()
    {
        return [
            [['a_con_id', 'a_id', 'a_status'], 'integer'],
            [['a_date', 'a_hash_video'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Archive::find();
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
            'a_id'=>$this->a_id,
            'a_con_id' => $this->a_con_id,
            'a_date' => $this->a_date,
            'a_status'=>$this->a_status,
            'a_hash_video' => $this->a_hash_video,
        ]);

        $query->andFilterWhere(['ilike', 'a_status', $this->a_status])
            ->andFilterWhere(['ilike', 'a_date', $this->a_date]);

        return $dataProvider;
    }
}