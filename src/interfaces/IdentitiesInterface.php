<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/10/24
 * Filename: ControllerInterface.php
 */

namespace ovidiupop\identities\interfaces;

use ovidiupop\identities\models\IdentityData;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

interface IdentitiesInterface
{
    /**
     * @return string
     */
    public function getControllerName(): string;

    /**
     * @return int
     */
    public function getType(): int;

    /**
     * @return array
     */
    public function gridData(): array;

}