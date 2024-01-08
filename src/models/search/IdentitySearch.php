<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: Identity.php
 */

namespace ovidiupop\identities\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ovidiupop\identities\models\Identity;
use yii\helpers\Inflector;

/**
 * IdentitySearch represents the model behind the search form about `ovidiupop\identities\models\Identity`.
 */
class IdentitySearch extends Identity
{
    //identity_data
    public $identityDataIdentityTypeId;
    public $identityDataName;
    public $identityDataIdentifier;
    public $identityDataPersonIdentifier; //is covered by identityDataIdentifier
    public $identityDataRegistrationNumber; //is covered by identityDataIdentifier
    public $identityDataVatNumber;
    public $identityDataVatRate;
    public $identityDataPhone;
    public $identityDataEmail;
    public $identityDataAdditionalInfo;
    public $identityDataContactPerson;
    public $identityDataIndustryId;
    public $identityDataRegistrationDate;

    //address
    public $addressFull;
    public $addressCountry;
    public $addressRegion;
    public $addressCity;
    public $addressStreet;
    public $addressHouseNumber;
    public $addressPostalCode;
    public $addressBlock;
    public $addressApartmentNumber;

    public $models = ['address', 'identity_data'];

    public $address_fields_exact = ['country'];
    public $address_fields_like = ['region', 'city', 'street', 'house_number', 'apartment_number', 'postal_code'];
    public $identity_data_fields_exact = ['identity_type_id', 'person_identifier'];
    public $identity_data_fields_like = ['name', 'registration_number', 'additional_info', 'vat_rate', 'vat_number', 'contact_person', 'phone', 'email', 'industry_id'];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'address_id', 'identity_data_id'], 'integer'],
            [[
                //IdentityData model
                'identityDataIdentityTypeId', 'identityDataName', 'identityDataIdentifier', 'identityDataPersonIdentifier', 'identityDataRegistrationNumber',
                'identityDataVatNumber', 'identityDataVatRate', 'identityDataPhone', 'identityDataEmail',
                'identityDataAdditionalInfo', 'identityDataContactPerson', 'identityDataIndustryId',
                'identityDataRegistrationDate',
                //Address model
                'addressFull', 'addressCountry', 'addressRegion', 'addressCity', 'addressStreet', 'addressHouseNumber',
                'addressPostalCode', 'addressApartmentNumber'

            ], 'safe'],
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

    private function mergedFields($fields_base)
    {
        $exact = $fields_base . '_exact';
        $like = $fields_base . '_like';
        return array_merge($this->{$exact}, $this->{$like});
    }

    /**
     * Make all fields sortable
     *
     * @param $dataProvider
     * @return mixed
     */
    public function makeSortable($dataProvider)
    {

        //special cases for sort
        $specialCases = [
            //useful when you have multiple fields used for a single attribute and must be sortable
            //attribute => preferred field for sort
            'identityDataIdentityTypeId' => 'identity_data.identity_type_id',
            'identityDataIdentifier' => 'identity_data.person_identifier',
            'addressFull' => 'address.street'
        ];
        foreach ($specialCases as $attribute => $field) {
            $dataProvider->sort->attributes[$attribute] = [
                'asc' => [$field => SORT_ASC],
                'desc' => [$field => SORT_DESC],
            ];
        }


        //normal fields
        foreach ($this->models as $class) {
            foreach ($this->mergedFields($class . '_fields') as $field) {
                $sortableField = lcfirst(Inflector::camelize($class)) . Inflector::camelize($field);
                $dataProvider->sort->attributes[$sortableField] = [
                    'asc' => [$class . '.' . $field => SORT_ASC],
                    'desc' => [$class . '.' . $field => SORT_DESC],
                ];
            }
        }

        return $dataProvider;
    }

    /**
     * @param $query
     * @param $class
     * @param $fields
     * @param $variable
     * @return mixed
     */
    private function filteringOr($query, $class, $fields, $variable)
    {
        $orConditions = ['OR'];
        foreach ($fields as $field) {
            $orConditions[] = ['like', $class . '.' . $field, $this->{$variable}];
        }
        $query->andFilterWhere($orConditions);
        return $query;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function makeFieldFilterableLike($query)
    {
        //filtering for addressFull (create a string from all data attributes see:address_fields_like,  (except country))
        if ($this->addressFull !== null) {
            $query = $this->filteringOr($query, 'address', $this->address_fields_like, 'addressFull');
        }

        //filtering for identityDataIdentifier (create a single column with both 'person_identifier' and 'registration_number')
        if ($this->identityDataIdentifier !== null) {
            $query = $this->filteringOr($query, 'identity_data', ['person_identifier', 'registration_number'], 'identityDataIdentifier');
        }

        //exact
        $query->andFilterWhere([
            'address.country' => $this->addressCountry
        ]);

        foreach ($this->models as $class) {
            $fields = $class . '_fields_like';
            foreach ($this->{$fields} as $field) {
                $query->andFilterWhere(['like', $class . '.' . $field,
                    $this->{lcfirst(Inflector::camelize($class . ucfirst($field)))}]);
            }
        }

        return $query;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function makeFieldFilterableExact($query)
    {
        //filtering for identity type
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        foreach ($this->models as $class) {
            $fields_name = $class . '_fields_exact';
            $fields = $this->$fields_name;
            foreach ($fields as $field) {
                $query->andFilterWhere([
                    $class . '.' . $field => $this->{lcfirst(Inflector::camelize($class . ucfirst($field)))}
                ]);
            }
        }

        return $query;
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
        $query = Identity::find();

        //join relations
        $query->joinWith(['address']);
        $query->joinWith(['identityData']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider = $this->makeSortable($dataProvider);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //make filterable all fields using exact
        $query = $this->makeFieldFilterableExact($query);

        //make filterable all fields using like
        $query = $this->makeFieldFilterableLike($query);

        return $dataProvider;
    }
}
