<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: IdentityController.php
 */


namespace ovidiupop\identities\controllers;

use ovidiupop\identities\IdentititiesAsset;
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
        $searchModel = new IdentitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Identity model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Identity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'addressModel' => $addressModel,
            'identityData' => $identityData
        ]);
    }

    /**
     * Updates an existing Identity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
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
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'addressModel' => $addressModel,
            'identityData' => $identityData
        ]);
    }

    /**
     * Deletes an existing Identity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
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
     * Finds the Identity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Identity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Identity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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

