<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/3/24
 * Filename: CompaniesController.php
 */

namespace backend\controllers;

use ovidiupop\identities\interfaces\IdentitiesTrait;
use ovidiupop\identities\models\IdentityData;
use yii\web\Controller;

class CompaniesController extends Controller
{
    use IdentitiesTrait;

    public $type = IdentityData::COMPANY;
    public $gridData = [
        'icon' => ICON_COMPANY
    ];
}
