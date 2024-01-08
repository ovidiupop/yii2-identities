
**Description**

The "identities" module is designed to manage and manipulate information related to identities, which can be either individuals or companies.
It provides functionalities such as handling data associated with these entities, displaying, and manipulating them.

**Installation**


The preferred method for installation is using Composer.

    composer require --prefer-dist ovidiupop/yii2-identities "@dev"

Or, add the following line to your composer.json file::

    "ovidiupop\yii2-identities": "@dev"

**Configuration:**

1. Run the migration in the migrations folder to create the necessary tables.

2. In the config/main.php file, add:

       'modules' => [
           'identities' => [
             'class' => 'ovidiupop\identities\IdentitiesModule',
           ],

**Usage**

In the create and update actions of the controller being used, you can proceed as follows:

    use ovidiupop\address\models\Address;

    public function actionCreate()
    {
        $model = new Model();
        $addressModel = new Address();

        if ($model->load(Yii::$app->request->post()) && $addressModel->load(Yii::$app->request->post())) {
            if ($addressModel->save()) {
                $model->address_id = $addressModel->id;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'addressModel' => $addressModel,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $addressModel = $model->address_id ? Address::findOne($model->address_id) :  new Address();

        if ($model->load(Yii::$app->request->post()) && $addressModel->load(Yii::$app->request->post())) {
            if ($addressModel->save()) {
                $model->address_id = $addressModel->id;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'addressModel' => $addressModel,
        ]);
    }

In the host model's form, add one of the predefined form variants for displaying the address fields:

 - If you want to display the inputs horizontally (default mode):

       <?php echo Yii::$app->getModule('address')->addressComponent->formInclude($addressModel, $form) ?>

- If you want to display the inputs in a vertical column:

      <?php echo Yii::$app->getModule('address')->addressComponent->formInclude($addressModel, $form, 1) ?>

- If you want to display the inputs in 2 vertical columns:

      <?php echo Yii::$app->getModule('address')->addressComponent->formInclude($addressModel, $form, 2) ?>


- If you want a custom form, you can either copy one of the existing three and adjust it according to your preferences,
  or create a completely new one. To use it, add the paths to the custom form or forms in the configuration as follows:


    'modules'=>[
        'address' => [
            'class' => 'ovidiupop\address\AddressModule',
            'formCustom' => '@path/to/views/my_custom_form',
        ],

In this case, the address form will be displayed in the form with:

    <?php echo Yii::$app->getModule('address')->addressComponent->formInclude($addressModel, $form, 'custom') ?>



**i18n**

For message translation, the 'app' convention [Yii::t('app', message)] has been used as the "category."

