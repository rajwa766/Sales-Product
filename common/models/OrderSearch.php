<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'order_request_id', 'entity_id', 'entity_type'], 'integer'],
            [['order_ref_no', 'shipper', 'cod', 'additional_requirements', 'file', 'requested_date'], 'safe'],
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
        $query = Order::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'order_request_id' => $this->order_request_id,
            'entity_id' => $this->entity_id,
            'entity_type' => $this->entity_type,
            'requested_date' => $this->requested_date,
        ]);

        $query->andFilterWhere(['like', 'order_ref_no', $this->order_ref_no])
            ->andFilterWhere(['like', 'shipper', $this->shipper])
            ->andFilterWhere(['like', 'cod', $this->cod])
            ->andFilterWhere(['like', 'additional_requirements', $this->additional_requirements])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
