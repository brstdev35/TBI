<?php

namespace TBI\Login\controllers;

use Yii;
use TBI\Login\models\RegisterUser;
use TBI\Login\models\RegisterUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for RegisterUser model.
 */
class RegisterController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() { 
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RegisterUser models.
     * @return mixed
     */
    public function actionIndex() {
        $this->layout = 'main';
        $searchModel = new RegisterUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegisterUser model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RegisterUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $this->layout = 'main';
        $model = new RegisterUser();
        $model->scenario = 'user_signup';

        if (Yii::$app->request->post()) {
            $model->load(\Yii::$app->request->post());
            $profile_pic = UploadedFile::getInstance($model, 'profile_pic');
            if ($profile_pic) {
                $profile_pic = UploadedFile::getInstance($model, 'profile_pic');
                $model->profile_pic = time() . '_' . $profile_pic->name;
                $profile_pic->saveAs('img/profile_pic/' . $model->profile_pic);
            } else {
                $model->profile_pic = '';
            }
            $model->setPassword($model->password);
            $model->created = time();
            $model->updated = time();
            $model->username = ucfirst($model->firstname) . ' ' . ucfirst($model->lastname);
           // echo '<pre>';print_r($model);die;
            if ($model->save(false)) {
                Yii::$app->session->setFlash('created', 'User ' . ucfirst($model->firstname) . ' ' . ucfirst($model->lastname) . ' has been Created Successfully!');
                return $this->redirect('index');
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RegisterUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $this->layout = 'main';
        $model = $this->findModel($id);
        $model->scenario = 'user_update';
        $oldprofilepic = $model->profile_pic;
        $user_pswd = $model->password;
        $model->password = '';

        if ($model->load(Yii::$app->request->post())) {  
            $postedData = Yii::$app->request->post();
            $profile_pic = UploadedFile::getInstance($model, 'profile_pic');
            if ($profile_pic) {
                $profile_pic = UploadedFile::getInstance($model, 'profile_pic');

                $model->profile_pic = time() . '_' . $profile_pic->name;
                $profile_pic->saveAs('img/profile_pic/' . $model->profile_pic);
            } else {
                if ($_POST['imgupdate'] == 1) {
                    if (!empty($model->profile_pic)) {
                        unlink('img/profilepic/' . $model->profile_pic);
                    }
                    $model->profile_pic = '';
                } else {
                    $model->profile_pic = $oldprofilepic;
                }
            }
            if ($postedData['RegisterUser']['password'] == ''): //Password not updated Case
                $model->password = $user_pswd;
            else: //Password updated Case
                $model->setPassword($postedData['RegisterUser']['password']);
            endif;
            $model->username = ucfirst($model->firstname) . ' ' . ucfirst($model->lastname);
            $model->updated = time();
            if ($model->save(false)) {
                Yii::$app->session->setFlash('created', 'User ' . ucfirst($model->firstname) . ' ' . ucfirst($model->lastname) . ' has been updated Successfully!');
                return $this->redirect('index');
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RegisterUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->layout = 'main';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RegisterUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RegisterUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        $this->layout = 'main';
        if (($model = RegisterUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
