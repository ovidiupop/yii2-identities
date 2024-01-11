<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/3/24
 * Filename: CompaniesController.php
 */

namespace backend\controllers;
use ovidiupop\identities\interfaces\IdentitiesInterface;
use ovidiupop\identities\interfaces\IdentitiesTrait;
use ovidiupop\identities\models\IdentityData;
use yii\web\Controller;


class PersonsController extends Controller implements IdentitiesInterface
{
    use IdentitiesTrait;

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return 'persons';
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return IdentityData::PERSON;
    }

    /**
     * @return array
     */
    public function gridData(): array
    {
        return [
            'icon'=>ICON_CUSTOMER
        ];
    }
}