<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\login\models\RegisterUser */

$this->title = 'Update Register User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Register Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="register-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
