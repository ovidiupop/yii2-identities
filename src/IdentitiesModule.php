<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: IdentitiesModule.php
 */

namespace ovidiupop\identities;

use yii\base\Module;

class IdentitiesModule extends Module
{
    /**
     * Path to columns.php.
     * Using configuration for module, you will be able to use your own configuration for columns
     * for example if you will use kartik/grid
     *
     * @var string
     */
    public $columnsFile = '@ovidiupop/identities/config/columns.php';

    /**
     * Which groups will be displayed in index. These groups can be configured in $groupsAttributes;
     * If you set $indexGroupsColumns = false, $visibleColumns will be used instead
     *
     * @var array|bool[]
     */
    public $indexGroupsColumns = ['identityData', 'address'];


    /**
     * If $indexGroupsColumns is set as false, in index grid will be displayed columns configured here;
     * Useful when you need to administrate a limited and very specific columns
     *
     * @var string[]
     */
    public $visibleColumns = ['identityDataIdentityTypeId', 'identityDataIdentifier', 'identityDataName'];


    /**
     * There are two models: address and identityData. For each of them you can set the visible (include) and order of attributes
     * in your grid.
     *
     * 'addressFull' is not a model, but a predefined group which will include two columns for address:
     *      1. country
     *      2. string with full address in this form: street, house_number, city, region, postal_code.
     *         Each of this attribute will not be included if they are not set.
     *         Filtering will be applied to all attributes
     *
     * @var array[]
     */
    public $groupsAttributes = [
        'address' => ['addressCountry', 'addressRegion', 'addressCity', 'addressStreet', 'addressHouseNumber',
            'addressPostalCode', 'addressApartmentNumber'],

        'identityData' => ['identityDataIdentityTypeId', 'identityDataName', 'identityDataIdentifier', 'identityDataPersonIdentifier',
            'identityDataRegistrationNumber', 'identityDataVatNumber', 'identityDataVatRate', 'identityDataPhone',
            'identityDataEmail', 'identityDataAdditionalInfo', 'identityDataContactPerson', 'identityDataIndustryId',
            'identityDataRegistrationDate'],

        'addressFull' => ['addressCountry', 'addressFull'],
    ];

    public $controllerNamespace = 'ovidiupop\identities\controllers';

    public function init()
    {
        parent::init();
    }
}