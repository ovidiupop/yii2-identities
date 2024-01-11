<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/11/24
 * Filename: TraitCompanies.php
 */

namespace ovidiupop\identities\interfaces;

use ovidiupop\identities\models\Identity;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use yii\web\NotFoundHttpException;
use yii\web\Response;

trait IdentitiesTrait
{
    /**
     * @return array[]
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    protected function generateControllerId(): string
    {
        $controllerClass = static::class;
        $controllerName = str_replace('Controller', '', substr($controllerClass, strrpos($controllerClass, '\\') + 1));
        return Inflector::camel2id($controllerName, '-');
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->generateControllerId();
    }

    /**
     * @return array
     */
    public function getGridData()
    {
        if (property_exists($this, 'gridData') && isset($this->gridData) && is_array($this->gridData)) {
            return $this->gridData;
        }
        return [];
    }

    /**
     * @return Response
     */
    public function actionIndex()
    {
        $c = $this->getControllerName();
        return $this->redirect(['/identities/identity/index',
            'controller' => $this->getControllerName(),
            'type' => $this->type,
            'grid_data' => $this->gridData
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        return $this->redirect(['/identities/identity/create',
            'controller' => $this->getControllerName(),
            'type' => $this->type,
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        return $this->redirect(['/identities/identity/update',
            'id' => $id,
            'controller' => $this->getControllerName(),
            'type' => $this->type,
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->redirect(['/identities/identity/view',
            'id' => $id,
            'controller' => $this->getControllerName(),
            'type' => $this->type,
        ]);
    }

    /**
     * @param $id
     * @return Response
     */
    public function actionDelete($id)
    {
        $controller = $this->getControllerName();
        $this->findModel($id)->delete();
        return $this->redirect(["/$controller/index"]);
    }

    /**
     * @param $id
     * @return Identity|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Identity::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
