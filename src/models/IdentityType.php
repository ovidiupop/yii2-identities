<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: IdentityType.php
 */


namespace ovidiupop\identities\models;

use common\models\Classification;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "identity_type".
 *
 * @property int $id
 * @property string $type
 *
 * @property Identity[] $identities
 */
class IdentityType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'identity_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('identities', 'ID'),
            'type' => Yii::t('identities', 'Type'),
        ];
    }

    /**
     * Gets query for [[Identities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentities()
    {
        return $this->hasMany(Identity::class, ['identity_type_id' => 'id']);
    }

    /**
     * @return mixed
     */
    public static function getCmb()
    {
        return ArrayHelper::map(
            self::find()->all(),
            'id', Yii::t('identities', 'type')
        );
    }
}
