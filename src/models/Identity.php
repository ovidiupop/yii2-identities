<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: Identity.php
 */

namespace ovidiupop\identities\models;

use ovidiupop\address\models\Address;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "identity".
 *
 * @property int $id
 * @property int $address_id
 * @property int $identity_data_id
 *
 * @property Address $address
 * @property IdentityData $identityData
 *
 */
class Identity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'identity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address_id', 'identity_data_id'], 'required'],
            [['address_id', 'identity_data_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('identities', 'ID'),
            'address_id' => Yii::t('identities', 'Address ID'),
            'identity_data_id' => Yii::t('identities', 'Identity Data'),

            // labels for relations and searchable
            'identityDataIdentityTypeId' => Yii::t('identities', 'Entity'),
            'identityDataName' => Yii::t('identities', 'Name'),
            'identityDataIdentifier' => Yii::t('identities', 'Identifier'),
            'identityDataPersonIdentifier' => Yii::t('identities', 'Person Identifier'),
            'identityDataRegistrationNumber' => Yii::t('identities', 'Registration Number'),
            'identityDataVatNumber' => Yii::t('identities', 'VAT Number'),
            'identityDataVatRate' => Yii::t('identities', 'VAT Rate'),
            'identityDataPhone' => Yii::t('identities', 'Phone'),
            'identityDataEmail' => Yii::t('identities', 'E-mail'),
            'identityDataAdditionalInfo' => Yii::t('identities', 'Additional Info'),
            'identityDataContactPerson' => Yii::t('identities', 'Contact Person'),
            'identityDataIndustryId' => Yii::t('identities', 'Industry'),
            'identityDataRegistrationDate' => Yii::t('identities', 'Registration Date'),

            'addressFull' => Yii::t('identities', 'Full Address'),
            'addressCountry' => Yii::t('identities', 'Country'),
            'addressRegion' => Yii::t('identities', 'Region'),
            'addressCity' => Yii::t('identities', 'City'),
            'addressStreet' => Yii::t('identities', 'Street'),
            'addressHouseNumber' => Yii::t('identities', 'House Number'),
            'addressApartmentNumber' => Yii::t('identities', 'Block/Apart.'),
            'addressPostalCode' => Yii::t('identities', 'Postal Code'),

        ];
    }

    /**
     * @param $countryCode
     * @return null
     */
    public static function countryName($countryCode)
    {
        $country = PersonIdentifierType::find()->where(['country' => $countryCode])->one();
        return $country->country_name ?? null;
    }

    /**
     * @param $countryCode
     * @return null
     */
    public function getCountryName($countryCode)
    {
        return self::countryName($countryCode);
    }


    //relations section

    /**
     * Gets query for [[Address]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddress(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Address::class, ['id' => 'address_id']);
    }

    /**
     * Gets query for [[IdentityData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentityData(): \yii\db\ActiveQuery
    {
        return $this->hasOne(IdentityData::class, ['id' => 'identity_data_id']);
    }
    //end relations section


    //getters section
    public function getAddressFull(): string
    {
        $components = [
            $this->address->house_number
                ? $this->address->street . ' ' . $this->address->house_number
                : $this->address->street,
            $this->address->city,
            $this->address->region,
            $this->address->postal_code,
        ];
        return implode(', ', $components);
    }
    //end getters section


    //options for filters section
    //special filters
    /**
     * @return mixed
     */
    public static function cmbPersonIdentifiers()
    {
        return ArrayHelper::map(IdentityData::find()->all(), 'id',
            static function ($data) {
                return $data->identity->identity_type_id === 1
                    ? $data->person_identifier
                    : $data->registration_number;
            });
    }

    /**
     * @return array
     */
    public static function cmbAddressCountries(): array
    {
        return ArrayHelper::map(Address::find()->all(), 'country',
            static function ($data) {
                return Identity::countryName($data->country);
            });
    }

    /**
     * @param $model
     * @param $column
     * @return array
     */
    public static function cmbColumnIdValues($model, $column): array
    {
        return ArrayHelper::map($model::find()
            ->groupBy([$column])
            ->andWhere(['not', [$column => null]])
            ->andWhere(['<>', $column, ''])
            ->all(), 'id', $column);
    }

    /**
     * @param $model
     * @param $column
     * @return array
     */
    public static function cmbColumnValues($model, $column): array
    {
        return ArrayHelper::map($model::find()
            ->select([$column])
            ->groupBy([$column])
            ->andWhere(['not', [$column => null]])
            ->andWhere(['<>', $column, ''])
            ->all(), $column, $column);
    }

    //end options for filters section


}
