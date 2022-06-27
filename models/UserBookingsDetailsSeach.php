<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserBookingsDetails;

/**
 * UserBookingsDetailsSeach represents the model behind the search form of `app\models\UserBookingsDetails`.
 */
class UserBookingsDetailsSeach extends UserBookingsDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'booking_id'], 'integer'],
            [['full_name', 'age', 'proof_type', 'identityfication_number', 'alloted_seat_no', 'status', 'created_date', 'updated_date'], 'safe'],
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
        $query = UserBookingsDetails::find();

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
            'booking_id' => $this->booking_id,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'proof_type', $this->proof_type])
            ->andFilterWhere(['like', 'identityfication_number', $this->identityfication_number])
            ->andFilterWhere(['like', 'alloted_seat_no', $this->alloted_seat_no])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
