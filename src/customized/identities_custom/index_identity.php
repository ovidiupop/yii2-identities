<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: index.php
 */

/* @var $this yii\web\View */
/* @var $searchModel ovidiupop\identities\models\search\IdentitySearch */
/* @var $searchIdentityData ovidiupop\identities\models\search\IdentityDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title string */
/* @var $name string */
/* @var $columnsForType string */
/* @var $config array|null */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

$columns = Yii::$app->getModule('identities')->getColumnsForGrid($searchModel, $dataProvider, $columnsForType);
?>

<div class="identity-index">
    <?php
    $actions = [
        [
            'class' => 'kartik\grid\ActionColumn',
            'width' => '50px',
            'dropdown' => false,
            'vAlign' => 'middle',
            'dropdownOptions' => ['class' => 'float-right'],
            'urlCreator' => function ($action, $model, $key, $index) use ($name) {
                $url = $name ? "/$name/$action" : $action;
                return \yii\helpers\Url::to([$url, 'id' => $key]);
            },
            'viewOptions' => ['class' => 'btn btn-xs btn-success', 'title' => Yii::t('app', 'View'), 'data-toggle' => 'tooltip'],
            'updateOptions' => ['class' => 'btn btn-xs btn-primary', 'title' => Yii::t('app', 'Edit'), 'data-toggle' => 'tooltip'],
            'deleteOptions' => ['class' => 'btn btn-xs btn-danger', 'title' => Yii::t('app', 'Delete'),
                'data-confirm' => Yii::t('app', 'Do you delete?'),
                'data-method' => 'post',
                'data-request-method' => 'post',
                'data-pjax' => '0',
            ],
            'header' => Yii::t('app', 'Operations'),
            'headerOptions' => ['class' => 'kartik-sheet-style'],
        ],
    ];

    $columns = array_merge($columns, $actions);
    ?>

    <div class="client-index">
        <?= \backend\components\grid\Grid::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $columns,
            'panelHeadingText' => $this->title,
            'panelHeadingIcon' => $config['icon'] ?? ICON_IDENTITY,
            'toolbarPlusUrl' => $name ? "/$name/create" : '/identities/identity/create',
            'toolbarReloadUrl' => $name ? "/$name/index" : '/identities/identity/index',
            'itemLabelSingle' => $name ? \yii\helpers\Inflector::singularize($name) : 'identity',
            'itemLabelPlural' => $name ? \yii\helpers\Inflector::pluralize($name) : 'identities',
            'export' => false,
            'toolbarPlusText' => Yii::t('app', 'Add {subject}', ['subject' => \yii\helpers\Inflector::singularize($name)]),
            'pjax' => true
        ]) ?>

    </div>


</div>
