<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: IdentityController.php
 */

namespace ovidiupop\identities\controllers;

use ovidiupop\identities\IdentititiesAsset;
use ovidiupop\identities\interfaces\IdentityControllerInterface;
use ovidiupop\identities\models\IdentityData;
use ovidiupop\identities\models\IdentityType;
use ovidiupop\identities\models\PersonIdentifierType;
use ovidiupop\identities\models\search\PersonIdentifierTypeSearch;
use ovidiupop\address\models\Address;
use Yii;
use ovidiupop\identities\models\Identity;
use ovidiupop\identities\models\search\IdentitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IdentityController implements the CRUD actions for Identity model.
 */
class IdentityController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return void
     */
    public function init()
    {
        $view = $this->view;
        IdentititiesAsset::register($view);
        parent::init();
    }

    /**
     * Lists all Identity models.
     * @return mixed
     */
    public function actionIndex()
    {
        list($controller, $title, $name, $index, $type, $form, $view, $grid_config, $grid_data) = $this->acquireData('index');
        $searchModel = new IdentitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere($type ? ['identity_type_id' => $type] : []);

        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'name' => $controller,
            'title' => $title,
            'columnsForType' => $grid_config,
            'config' => $grid_data
        ]);
    }

    /**
     * Prepare date for CRUD
     * @param $mode
     * @return array
     */
    public function acquireData($mode)
    {
        $moduleIdentities = Yii::$app->getModule('identities');
        $request = Yii::$app->getRequest();
        $controller = $request->get('controller', null);
        $title = $controller ? \yii\helpers\Inflector::pluralize(ucfirst($controller)) : Yii::t('identities', 'Identities');
        $name = $controller ? ucfirst(Yii::t('identities', $controller)) : 'Identities';
        $index = $controller ? ["/$controller/index"] : 'index';
        $type = $request->get('type', null);
        $form = $type ? $moduleIdentities->formPersonCompany : ($moduleIdentities->form ?? '_form');
        $grid_config = $controller
            ? ($type == IdentityData::PERSON ? $moduleIdentities->gridConfigPersons : $moduleIdentities->gridConfigCompanies)
            : $moduleIdentities->gridConfig;
        $grid_data = $request->get('grid_data', null);
        $viewMap = [
            'form' => $controller ? "/$controller/view" : 'view',
            'view' => $moduleIdentities->view ?? 'view',
            'index' => $moduleIdentities->index ?? 'index',
        ];
        $view = $viewMap[$mode] ?? 'index';
        return [$controller, $title, $name, $index, $type, $form, $view, $grid_config, $grid_data];
    }

    /**
     * Displays a single Identity model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        list($controller, $title, $name, $index, $type, $form, $view, $grid_config, $grid_data) = $this->acquireData('view');

        $model = $this->findModel($id);
        $prefix = $controller
            ? Yii::t('identities', ucfirst(\yii\helpers\Inflector::singularize($controller)))
            : Yii::t('identities', 'Identity');
        $title = $prefix . ': ' . $model->identityData->name;

        return $this->render($view, [
            'model' => $model,
            'index' => $index,
            'name' => $name,
            'controller' => $controller,
            'title' => $title
        ]);
    }

    /**
     * Finds the Identity model based on its primary key value
     * and related identity_data.identity_type_id based on type.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     * @return Identity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        //if is set a type, we also check if id corespond to that type
        if ($type = Yii::$app->getRequest()->get('type', null)) {
            $model = Identity::find()
                ->joinWith('identityData')
                ->where(['identity.id' => $id, 'identity_data.identity_type_id' => $type])
                ->one();

            if ($model !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist or has an invalid identity type.');
        }

        if (($model = Identity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Identity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        list($controller, $title, $name, $index, $type, $form, $view, $grid_config, $grid_data) = $this->acquireData('form');

        $model = new Identity();
        $addressModel = new Address();
        $identityData = new IdentityData();

        if (
            $addressModel->load(Yii::$app->request->post()) &&
            $identityData->load(Yii::$app->request->post())) {

            if ($addressModel->save() && $identityData->save()) {
                $model->address_id = $addressModel->id;
                $model->identity_data_id = $identityData->id;

                if ($model->save()) {
                    if ($controller !== null) {
                        return $this->redirect([$view, 'id' => $model->id]);
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'addressModel' => $addressModel,
            'identityData' => $identityData,

            'type' => $type,
            'index' => $index,
            'form' => $form,
            'name' => $name,
        ]);
    }

    /**
     * Updates an existing Identity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        list($controller, $title, $name, $index, $type, $form, $view, $grid_config, $grid_data) = $this->acquireData('form');

        $model = $this->findModel($id);
        $addressModel = Address::findOne($model->address_id);
        $identityData = IdentityData::findOne($model->identity_data_id);

        if (
            $addressModel->load(Yii::$app->request->post()) &&
            $identityData->load(Yii::$app->request->post())) {

            if ($addressModel->save() && $identityData->save()) {
                $model->address_id = $addressModel->id;
                $model->identity_data_id = $identityData->id;

                if ($model->save()) {
                    if ($controller !== null) {
                        return $this->redirect([$view, 'id' => $model->id]);
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'addressModel' => $addressModel,
            'identityData' => $identityData,
            'index' => $index,
            'view' => $view,
            'name' => $name,
            'form' => $form
        ]);
    }

    /**
     * Deletes an existing Identity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $country
     * @return mixed|null
     */
    public function actionLoadPersonIdentifierType($country)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        /** @var PersonIdentifierType $personIdentifierType */
        $personIdentifierType = PersonIdentifierType::find()->where(['country' => $country])->one();

        if ($personIdentifierType !== null) {
            return ['id' => $personIdentifierType->id, 'type' => $personIdentifierType->type];
        }

        return ['id' => null, 'type' => null];
    }

}

