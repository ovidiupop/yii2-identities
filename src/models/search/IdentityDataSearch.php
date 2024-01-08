<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: IdentityData.php
 */

namespace ovidiupop\identities\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ovidiupop\identities\models\IdentityData;

/**
 * IdentityDataSearch represents the model behind the search form about `ovidiupop\identities\models\IdentityData`.
 */
class IdentityDataSearch extends IdentityData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_identifier_type_id', 'industry', 'registration_date'], 'integer'],
            [['name', 'person_identifier', 'phone', 'email', 'additional_info', 'registration_number', 'vat_number', 'contact_person'], 'safe'],
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
    public function search($params): ActiveDataProvider
    {
        $query = IdentityData::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'person_identifier_type_id' => $this->person_identifier_type_id,
            'registration_date' => $this->registration_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'person_identifier', $this->person_identifier])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'additional_info', $this->additional_info])
            ->andFilterWhere(['like', 'registration_number', $this->registration_number])
            ->andFilterWhere(['like', 'vat_number', $this->vat_number])
            ->andFilterWhere(['like', 'vat_rate', $this->vat_rate])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'industry', $this->industry]);

        return $dataProvider;
    }
}
