<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/4/24
 * Filename: IndustryComponent.php
 */

namespace ovidiupop\identities\components\industry;

use yii\base\Component;
use Yii;

class IndustryComponent extends Component
{
    public $industries;

    public function init()
    {
        parent::init();

        $this->industries = [
            '1' => Yii::t('identities', 'Aerospace'),
            '2' => Yii::t('identities', 'Agriculture'),
            '3' => Yii::t('identities', 'Animal Care'),
            '4' => Yii::t('identities', 'Art and Entertainment'),
            '5' => Yii::t('identities', 'Automotive'),
            '6' => Yii::t('identities', 'Banking'),
            '7' => Yii::t('identities', 'Blockchain Technology'),
            '8' => Yii::t('identities', 'Chemistry'),
            '9' => Yii::t('identities', 'Construction'),
            '10' => Yii::t('identities', 'Consulting'),
            '11' => Yii::t('identities', 'Cosmetics Industry'),
            '12' => Yii::t('identities', 'E-commerce'),
            '13' => Yii::t('identities', 'Education'),
            '14' => Yii::t('identities', 'Electronics'),
            '15' => Yii::t('identities', 'Energy'),
            '16' => Yii::t('identities', 'Environment/Nature Care'),
            '17' => Yii::t('identities', 'Fashion'),
            '18' => Yii::t('identities', 'Finance'),
            '19' => Yii::t('identities', 'Food and Beverages'),
            '20' => Yii::t('identities', 'Furniture'),
            '21' => Yii::t('identities', 'Governmental Organizations'),
            '22' => Yii::t('identities', 'Green Technology'),
            '23' => Yii::t('identities', 'Health'),
            '24' => Yii::t('identities', 'Insurance'),
            '25' => Yii::t('identities', 'Interior Design'),
            '26' => Yii::t('identities', 'Jewelry'),
            '27' => Yii::t('identities', 'Logistics and Distribution'),
            '28' => Yii::t('identities', 'Luxury Goods'),
            '29' => Yii::t('identities', 'Media and Communications'),
            '30' => Yii::t('identities', 'Metalurgy'),
            '31' => Yii::t('identities', 'Music and Online Entertainment'),
            '32' => Yii::t('identities', 'Non-profit Organizations'),
            '33' => Yii::t('identities', 'Online Education'),
            '34' => Yii::t('identities', 'Pharmaceuticals'),
            '35' => Yii::t('identities', 'Professional Services (legal, accounting)'),
            '36' => Yii::t('identities', 'Real Estate'),
            '37' => Yii::t('identities', 'Recycling'),
            '38' => Yii::t('identities', 'Recreation and Sports'),
            '39' => Yii::t('identities', 'Renewable Energy'),
            '40' => Yii::t('identities', 'Research and Development'),
            '41' => Yii::t('identities', 'Retail'),
            '42' => Yii::t('identities', 'Robotics'),
            '43' => Yii::t('identities', 'Social Services'),
            '44' => Yii::t('identities', 'Space Industry'),
            '45' => Yii::t('identities', 'Technology/IT'),
            '46' => Yii::t('identities', 'Telecommunications'),
            '47' => Yii::t('identities', 'Textiles'),
            '48' => Yii::t('identities', 'Tourism'),
            '49' => Yii::t('identities', 'Transportation'),
            '50' => Yii::t('identities', 'Video Games'),
            '51' => Yii::t('identities', 'Virtual Reality Technology'),
            '52' => Yii::t('identities', 'Wine Industry'),
        ];
    }

    public function getIndustryByIndex($index)
    {
        if (array_key_exists($index, $this->industries)) {
            return $this->industries[$index];
        }
        return Yii::t('identities', 'Industry does not exists!');
    }
}