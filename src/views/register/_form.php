<?php

use yii\helpers\html;
use yii\bootstrap\ActiveForm;
?>
<div class="user-form">
    <div class='row'>

        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">

                    <h3 class="box-title">Add User</h3>
                </div>
                <div class="box-body">
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'login-dash',
                                'options' => ['enctype' => 'multipart/form-data']]);
                    ?> 
                    <?=
                    $form->field($model, 'firstname')->label('First Name');
                    ?>
                    <?=
                    $form->field($model, 'lastname');
                    ?>
                    <?=
                    $form->field($model, 'email')->textInput()->label('Email Address');
                    ?>
                    <?=
                    $form->field($model, 'password')->passwordInput(['value' => ''])->label('Password');
                    ?>
                    <?=
                    $form->field($model, 'confirm_password')->passwordInput(['value' => ''])->label('Confirm Password');
                    ?>
                    <?= $form->field($model, 'status')->radioList(array(1 => 'Active', 0 => 'Inactive'))->label('Status'); ?>
                    <?php
                    if ((!empty($model->profile_pic))) {
                        $imgcheck = 1;
                        $class = 'existimage';
                    } else {
                        $imgcheck = 0;
                        $class = '';
                    }
                    ?>
                    <?= $form->field($model, 'profile_pic')->fileInput(['accept' => 'image/*', 'id' => 'browse', 'class' => $class]); ?>

                    <div class="form-group">
                        <input id='imgcheck' type='hidden' name='img_check' value='<?php echo $imgcheck; ?>'>
                        <input id='imgupdate' type='hidden' name="imgupdate" value='0'>
                        <img id="removeimage"style="margin-right:20px;width:100px;"src="/advanced/frontend/web/img/profile_pic/<?php echo $model->profile_pic ?>"><button id="remove">Remove</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <span class="cancel_btn">
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
        </span>
    </div>
    <?php ActiveForm::end(); ?>
</div>
