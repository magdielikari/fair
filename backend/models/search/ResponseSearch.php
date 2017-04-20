<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Response;

/**
 * ResponseSearch represents the model behind the search form about `common\models\Response`.
 */
class ResponseSearch extends Response
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id1', 'ordernumber', 'created_at', 'created_by', 'updated_at', 'updated_by', 'order_id'], 'integer'],
            [['success', 'message', 'id', 'code', 'reference', 'voucher', 'sequence', 'approval', 'lote', 'responsecode', 'deferred', 'datetime'], 'safe'],
            [['amount'], 'number'],
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
        $query = Response::find();

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
            'id1' => $this->id1,
            'ordernumber' => $this->ordernumber,
            'datetime' => $this->datetime,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'order_id' => $this->order_id,
        ]);

        $query->andFilterWhere(['like', 'success', $this->success])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'voucher', $this->voucher])
            ->andFilterWhere(['like', 'sequence', $this->sequence])
            ->andFilterWhere(['like', 'approval', $this->approval])
            ->andFilterWhere(['like', 'lote', $this->lote])
            ->andFilterWhere(['like', 'responsecode', $this->responsecode])
            ->andFilterWhere(['like', 'deferred', $this->deferred]);

        return $dataProvider;
    }
}
