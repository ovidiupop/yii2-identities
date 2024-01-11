<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: index.php
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel ovidiupop\identities\models\search\IdentitySearch */
/* @var $searchIdentityData ovidiupop\identities\models\search\IdentityDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('identities', 'Identities');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="identity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('identities', 'Create Identity'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?php
    //for original index columns must stay here, after Pjax begin.
    $columns = Yii::$app->getModule('identities')->getColumnsForGrid($searchModel, $dataProvider);
    $columns = array_merge($columns, [['class' => 'yii\grid\ActionColumn']]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns
    ]); ?>
    <?php Pjax::end(); ?>

</div>
