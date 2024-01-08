<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: index.php
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel ovidiupop\identities\models\search\IdentityDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('identities', 'Identity Data');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identity-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('identities', 'Create Identity Data'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'person_identifier_type_id',
            'person_identifier',
            'phone',
            'email',
            'additional_info',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
