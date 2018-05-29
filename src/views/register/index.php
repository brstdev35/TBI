<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RegisterUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Register Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="register-user-index">
    <?php if (Yii::$app->session->getFlash('updated')) { ?>
        <div class="callout callout-success">
            <i class="icon fa fa-check"></i>
            <?php echo Yii::$app->session->getFlash('updated'); ?>
        </div>
    <?php } ?>
    <?php if (Yii::$app->session->getFlash('created')) { ?>
        <div class="callout callout-success">
            <i class="icon fa fa-check"></i>
            <?php echo Yii::$app->session->getFlash('created'); ?>
        </div>
    <?php } ?>
    <?php if (Yii::$app->session->getFlash('deleted')) { ?>
        <div class="callout callout-success">
            <i class="icon fa fa-check"></i>
            <?php echo Yii::$app->session->getFlash('deleted'); ?>
        </div>
    <?php } ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <div class="grid_user grid_verical">
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">User Listing</h3>
                <?= Html::a('Add User<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-default pull-right']) ?>
            </div>
            <?php Pjax::begin(); ?>    
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn',
                        'header' => 'S No.',
                        'headerOptions' => ['width' => '60'],
                    ],
                    'firstname',
                    'lastname',
                    'email',
                    [
                        'label' => 'Status',
                        'attribute' => 'status',
                        'filter' => array('1' => 'Active', '0' => 'Inactive'),
                        'format' => 'raw',
                        'headerOptions' => ['width' => '100'],
                        'value' => function ($model) {
                            if ($model->status == 1):
                                return 'Active';
                            else:
                                return 'Inactive';
                            endif;
                        },
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
<style>
    .summary {
    display: none;
}
</style>
