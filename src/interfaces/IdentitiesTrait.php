<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/11/24
 * Filename: TraitCompanies.php
 */

namespace ovidiupop\identities\interfaces;

use ovidiupop\identities\models\Identity;
use ovidiupop\identities\models\IdentityData;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

trait IdentitiesTrait
{
    /**
     * @return array[]
     */
    public function behaviors() {
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
     * @return Response
     */
    public function actionIndex()
    {
        return $this->redirect(['/identities/identity/index',
            'controller' => $this->getControllerName(),
            'type' => $this->getType(),
            'grid_data'=>$this->gridData()
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        return $this->redirect(['/identities/identity/create',
            'controller' => $this->getControllerName(),
            'type' => $this->getType(),
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
            'type' => $this->getType(),
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
            'type' => $this->getType(),
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
