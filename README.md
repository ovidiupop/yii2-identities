The "identities" module is designed for managing and manipulating information related to both individuals and companies. It provides functionalities for handling associated data, displaying, and performing manipulations.

**Installation**

The recommended installation method is using Composer.
````
composer require --prefer-dist ovidiupop/yii2-identities "@dev"
````
Or, add the following line to your composer.json file:
````
"ovidiupop\yii2-identities": "@dev"
````

**Configuration**

Run the migration located in the migrations folder to create the necessary tables.
In the config/main.php file, add:
````
'modules' => [
    'identities' => [
        'class' => 'ovidiupop\identities\IdentitiesModule',
    ],
],
````

**Usage**

To manage all entities on a single page without customization, visit /identities/identity/index. Here, you can add, update, and delete both individual and company identities.

**Customization**

The module utilizes standard Yii2 components (GridView and DetailView), and the design follows the default styling.

For customization, the following configurations are available:

Example for full customization:
```
'modules' => [
    'identities' => [
        'class' => 'ovidiupop\identities\IdentitiesModule',
        'addressFormCustom' => '@backend/identities_custom/custom_address_form',
        'form' => '@backend/identities_custom/_form_identity',
        'formPersonCompany' => '@backend/identities_custom/form_person_company',
        'view' => '@backend/identities_custom/view_identity',
        'index' => '@backend/identities_custom/index_identity',
        --------------------- .php is required ----------------
        'columns' => '@backend/identities_custom/columns.php',
        'gridConfig' => '@backend/identities_custom/grid_config.php',
        'gridConfigPersons' => '@backend/identities_custom/grid_config_persons.php',
        'gridConfigCompanies' => '@backend/identities_custom/grid_config_companies.php',
        ]
    ..................
```

***Customization details:***

    addressFormCustom - the file where the address data collection form is configured.
    form - the file for creating and updating new identities.
    formPersonCompany - the file for customizing forms for persons and companies.
    view - the view file.
    index - the index file for accessing the grid of registered identities.
    columns - if using custom grids (e.g., kartik/Grid), prepare the grid columns accordingly.
    gridConfig - the file where the order and visibility of grid columns are set.
    gridConfigPersons - when displaying only entities of type Person, set the order and visibility of grid columns.
    gridConfigCompanies - when displaying only entities of type Company, set the order and visibility of grid columns.
    To begin customization, copy the module's files to your project folder and then personalize them as needed.


In the index_identity.php file, obtain the columns for the grid as follows:

````
// For all columns
$columns = Yii::$app->getModule('identities')->getColumnsForGrid($searchModel, $dataProvider);

// For separate entities in the index, add an extra parameter "$columnsForType" received from the controller.
$columns = Yii::$app->getModule('identities')->getColumnsForGrid($searchModel, $dataProvider, $columnsForType);
````


To manage specialized identities separately, create a controller for each type (persons and companies) in your project. Controllers should implement the IdentitiesInterface and use the IdentitiesTrait. A complete controller should look like this:
````
<?php
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
        return 'persons'; // the controller name in lowercase
    }

    /**
     * The type of managed entity 
     * (IdentityData::PERSON = 1, IdentityData::COMPANY = 2)
     *
     * @return int
     */
    public function getType(): int
    {
        return IdentityData::PERSON; 
    }

    /**
     * This function allows sending parameters to the index file for customizing the grid based on preferences.
     * in index.php you can use like this: 'panelHeadingIcon' => $config['icon'] ?? ICON_IDENTITY,
     *
     * @return array
     */
    public function gridData(): array
    {
        return [
            'icon' => ICON_CUSTOMER,
        ];
    }
}
````


For message translation, use the 'identities' convention [Yii::t('identities', message)].