<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\login\models\RegisterUser */

$this->title = 'Create Register User';
$this->params['breadcrumbs'][] = ['label' => 'Register Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="register-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
