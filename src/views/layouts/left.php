<?php

use vendor\almasaeed2010\adminlte\pages;
use yii\helpers\Html;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
<!--            <div class="pull-left image">
<?//= Html::img('@web/upload1/' . Yii::$app->user->identity->image, ['class' => "img-circle"]); ?>
            </div>-->
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        [
                            'label' => 'Users',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Add Users', 'icon' => 'fa fa-fw fa-user', 'url' => ['/login/register/create'],],
                                ['label' => 'user-listing', 'icon' => 'fa fa-users', 'url' => ['/login/register/index'],],
                            ],
                        ],
                    ],
                ]
        )
        ?>

    </section>

</aside>