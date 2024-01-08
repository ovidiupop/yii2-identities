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
    $module = Yii::$app->getModule('identities');
    $columns = [];
    $columnsConfig = require(Yii::getAlias($module->columnsFile));

    if ($module->indexGroupsColumns && is_array($module->indexGroupsColumns)) {
        foreach ($module->indexGroupsColumns as $groupColumn) {
            foreach ($module->groupsAttributes[$groupColumn] as $attribute) {
                $columns[] = $columnsConfig[$attribute] ?? null;
            }
        }
    } else {
        $visibleColumns = $module->visibleColumns;
        foreach ($visibleColumns as $key) {
            $columns[] = $columnsConfig[$key] ?? null;
        }
    }

    $columns = array_filter($columns);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => array_merge($columns, [['class' => 'yii\grid\ActionColumn']]),
    ]); ?>
    <?php Pjax::end(); ?>

</div>
