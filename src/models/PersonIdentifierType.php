<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: PersonIdentifierType.php
 */


namespace ovidiupop\identities\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "person_identifier_type".
 *
 * @property int $id
 * @property string $type
 * @property string $country
 * @property string $country_name
 *
 * @property IdentityData[] $identityData
 */
class PersonIdentifierType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person_identifier_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country', 'type'], 'required'],
            [['type'], 'string', 'max' => 255],
            [['country'], 'string', 'max' => 2],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('identities', 'ID'),
            'country' => Yii::t('identities', 'Country Code'),
            'country_name' => Yii::t('identities', 'Country'),
            'type' => Yii::t('identities', 'Type'),
        ];
    }

    /**
     * Gets query for [[IdentityData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentityData()
    {
        return $this->hasMany(IdentityData::class, ['person_identifier_type_id' => 'id']);
    }

    /**
     * @param $country
     * @return mixed|null
     */
    public function getPersonIdentifierTypeByCountry($country)
    {
        return self::find()->where(['country' => $country])->one();
    }

    public static function getCmb()
    {
        return ArrayHelper::map(self::find()->all(),
            'id', Yii::t('identities', 'type'));
    }

}
