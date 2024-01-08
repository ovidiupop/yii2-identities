<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: Industry.php
 */


namespace ovidiupop\identities\models;

use Yii;

/**
 * This is the model class for table "industry".
 *
 * @property int $id
 * @property string $name
 *
 * @property IdentityData[] $identityData
 */
class Industry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'industry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('identities', 'ID'),
            'name' => Yii::t('identities', 'Name'),
        ];
    }

    /**
     * Gets query for [[IdentityData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentityData()
    {
        return $this->hasMany(IdentityData::class, ['industry_id' => 'id']);
    }
}
