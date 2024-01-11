<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: IdentitiesModule.php
 */

namespace ovidiupop\identities;

use yii\base\Module;

/**
 * Module for handling identities.
 *
 * @property string $addressFormCustom Path to the custom form for the address module.
 * @property string $columns Path to columns.php defining columns for GridView.
 * @property string $gridConfig Path to grid_config.php defining order and visibility for columns.
 * @property string $gridConfigPersons Path to grid_config_persons.php for grid configuration for persons.
 * @property string $gridConfigCompanies Path to grid_config_companies.php for grid configuration for companies.
 * @property string $form Path to the custom index for identities/identity/_form.
 * @property string $index Path to the custom index for identities/identity/index.
 * @property string $view Path to the custom view for identities/identity/view.
 *
 */
class IdentitiesModule extends Module
{
    public $controllerNamespace = 'ovidiupop\identities\controllers';

    /**
     * Path to columns.php.
     * Here are definited columns for GridView.
     *
     * @var string
     */
    public $columns = '@ovidiupop/identities/config/columns.php';

    /**
     * Path to grid_config.php.
     * Here you will define the order and visibility for columns used.
     *
     * @var string
     */
    public $gridConfig = '@ovidiupop/identities/config/grid_config.php';

    /**
     * Path to grid_config_persons.php.
     * Here, you can define the order and visibility of columns used by the grid for persons.
     *
     * @var string
     */
    public $gridConfigPersons = '@ovidiupop/identities/config/grid_config_persons.php';

    /**
     * Path to grid_config_persons.php.
     * Here, you can define the order and visibility of columns used by the grid for companies.
     *
     * @var string
     */
    public $gridConfigCompanies = '@ovidiupop/identities/config/grid_config_companies.php';

    /**
     * Path to the custom form for the address module.
     *
     * @var string
     */
    public $addressFormCustom;

    /**
     * Path to the custom index for identities/identity/index.
     * @var
     */
    public $index;

    /**
     * Path to the custom index for identities/identity/_form.
     * @var
     */
    public $form;

    /**
     * Path to the custom index for identities/identity/_form.
     * @var
     */
    public $formPersonCompany = '@ovidiupop/identities/config/form_person_company';

    /**
     * Path to the custom index for identities/identity/view.
     * @var
     */
    public $view;

    /**
     * Retrieves and returns an array of columns based on the specified search model, data provider,
     * and optionally a custom grid order configuration.
     *
     * @param mixed $searchModel The search model for the grid.
     * @param mixed $dataProvider The data provider for the grid.
     * @param mixed|false $gridConfig Custom grid configuration file path (optional).
     *  If not provided, the default configuration from the component will be used.
     * @return array An array of columns based on the specified criteria.
     */
    public function getColumnsForGrid($searchModel, $dataProvider, $gridConfig=false)
    {
        $gridConfig = $gridConfig ?:  $this->gridConfig;
        $gridConfig = require(\Yii::getAlias($gridConfig));
        $columnsConfig = require(\Yii::getAlias($this->columns));

        $columns = [];
        $visibleColumns = $gridConfig['visible'];

        foreach ($visibleColumns as $column){
            if(array_key_exists($column, $columnsConfig)){
                $columns[] = $columnsConfig[$column];
            }
        }

        $columns = array_filter($columns);
        return $columns;
    }

    /**
     * Initializes the module, registering dependent modules and configuring necessary components.
     * It sets up the module using configuration from the main.php file and allows customization
     * by incorporating a custom form for the address module if specified.
     */
    public function init()
    {
        parent::init();
        //register dependant modules
        $config = require __DIR__ . '/config/main.php';
        //use own customFormAddress
        $config['modules']['address']['formCustom'] = $this->addressFormCustom;

        \Yii::$app->setModules($config['modules']);
        \Yii::$app->setComponents($config['components']);

        //register else if there is something
        \Yii::configure($this, $config);
    }

}