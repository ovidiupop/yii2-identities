<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: IdentityData.php
 */


namespace ovidiupop\identities\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "identity_data".
 *
 * @property int $id
 * @property int $identity_type_id
 * @property string $name
 * @property int|null $person_identifier_type_id
 * @property string|null $person_identifier
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $additional_info
 * @property string|null $registration_number
 * @property string|null $vat_number
 * @property float|null $vat_rate
 * @property string|null $contact_person
 * @property int|null $industry_id
 * @property string|null $registration_date
 *
 * @property IdentityType $identityType
 * @property PersonIdentifierType $personIdentifierType
 * @property Industry $industry
 * @property Identity[] $identities
 */
class IdentityData extends \yii\db\ActiveRecord
{

    public $namesOptions;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'identity_data';
    }

    const PERSON = 1;
    const COMPANY = 2;

    public function rules()
    {
        return [
            [['vat_rate'], 'number'],
            [['identity_type_id', 'person_identifier_type_id', 'industry_id'], 'integer'],
            [['registration_date'], 'safe'],
            [['identity_type_id', 'name'], 'required'],
            [['phone', 'email', 'additional_info', 'vat_number', 'contact_person', 'registration_date'], 'string', 'max' => 255],
            [['person_identifier'], 'required', 'when' => function ($model) {
                return $model->identity_type_id === self::PERSON;
            }, 'whenClient' => "function (attribute, value) {
                return $('#identitydata-identity_type_id').val() =='" . self::PERSON . "';
            }"],
            [['registration_number'], 'required', 'when' => function ($model) {
                return $model->identity_type_id === self::COMPANY;
            }, 'whenClient' => "function (attribute, value) {
                return $('#identitydata-identity_type_id').val() =='" . self::COMPANY . "';
            }"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('identities', 'ID'),
            'identity_type_id' => Yii::t('identities', 'Entity'),
            'person_identifier_type_id' => Yii::t('identities', 'Person Identifier Type ID'),
            'person_identifier' => Yii::t('identities', 'Person Identifier'),
            'phone' => Yii::t('identities', 'Phone'),
            'email' => Yii::t('identities', 'Email'),
            'additional_info' => Yii::t('identities', 'Additional Info'),
            'name' => Yii::t('identities', 'Firstname Lastname / Company Name'),
            'registration_number' => Yii::t('identities', 'Registration Number'),
            'vat_number' => Yii::t('identities', 'Vat Number'),
            'vat_rate' => Yii::t('identities', 'Vat Rate'),
            'contact_person' => Yii::t('identities', 'Contact Person'),
            'industry_id' => Yii::t('identities', 'Industry ID'),
            'registration_date' => Yii::t('identities', 'Registration Date'),
        ];
    }


    /**
     * @return mixed
     */
    public function beforeValidate()
    {
        if ((int)$this->identity_type_id === self::PERSON) {
            $this->registration_number = null;
        }
        if ((int)$this->identity_type_id === self::COMPANY) {
            $this->person_identifier = null;
        }
        return parent::beforeValidate();
    }


    /**
     * Gets query for [[IdentityType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentityType(): \yii\db\ActiveQuery
    {
        return $this->hasOne(IdentityType::class, ['id' => 'identity_type_id']);
    }


    /**
     * Gets query for [[PersonIdentifierType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonIdentifierType()
    {
        return $this->hasOne(PersonIdentifierType::class, ['id' => 'person_identifier_type_id']);
    }

    /**
     * Gets query for [[Industry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndustry()
    {
        return $this->hasOne(Industry::class, ['id' => 'industry_id']);
    }

    /**
     * Gets query for [[Identities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentities()
    {
        return $this->hasMany(Identity::class, ['identity_data_id' => 'id']);
    }

    /**
     * @return Identity
     */
    public function getIdentity()
    {
        return $this->identities[0];
    }

}
