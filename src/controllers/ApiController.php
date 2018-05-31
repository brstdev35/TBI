<?php

namespace TBI\Login\controllers;

use TBI\Login\models\Employee;
use TBI\Login\models\RegisterUser;
use TBI\Login\models\Country;
use TBI\Login\models\City;
use TBI\Login\models\State;
use TBI\Login\models\Role;

class ApiController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    public function actionIndex() {
        echo 'this is test';
        die;
        return $this->render('index');
    }

    public function actionCreate() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $employee = new RegisterUser();
        $employee->scenario = 'user_signup';
        $employee->attributes = \Yii::$app->request->post();
        if (!empty($_POST['countryname'])):
            $country = Country::find()->where(['countryname' => $_POST['countryname']])->one();
            if (!empty($country)):
                $employee->country = $country->id;
                if (!empty($_POST['statename'])):
                    $state = State::find()->where(['statename' => $_POST['statename'], 'country_id' => $country->id])->one();
                    if (!empty($state)):
                        $employee->state = $state->id;
                        if (!empty($_POST['cityname'])):
                            $city = City::find()->where(['cityname' => $_POST['cityname'], 'country_id' => $country->id, 'state_id' => $employee->state])->one();
                            if (!empty($city)):
                                $employee->city = $city->id;
                            else:
                                return array('status' => false, 'error' => 'No such City exists');
                            endif;
                        endif;
                    else:
                        return array('status' => false, 'error' => 'No such State exists');
                    endif;
                endif;
            else:
                return array('status' => false, 'error' => 'No such country exists');
            endif;
        endif;
        $employee1 = RegisterUser::find()->where(['email' => $employee->email])->one();
        if (!empty($employee1)):
            return array('status' => true, 'data' => 'data exists already.');
        endif;
        if ($employee->validate()) {
            $role = Role::findOne($employee->role);
            if (empty($role)):
                return array('status' => false, 'error' => 'now such role exists');
            endif;
            $employee->setPassword($employee->password);
            $employee->status = 1;
            $employee->created = time();
            $employee->updated = time();
            $employee->save(false);
            return array('status' => true, 'data' => 'data saved successfully');
        } else {
            return array('status' => false, 'error' => $employee->getErrors());
        }
    }

    public function actionList() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $employee = RegisterUser::find()->all();
        $count = RegisterUser::find()->count();
        if ($count > 0) {
            foreach ($employee as $user):
                $country = Country::findOne($user->country);
                $state = State::findOne($user->state);
                $city = City::findOne($user->city);
                $role = Role::findOne($user->role);
                if ($user->status == 0):
                    $status = "Inactive";
                else:
                    $status = "Active";
                endif;
                $dataxls[] = array('id' => $user->id, 'firstname' => $user->firstname, 'lastname' => $user->lastname, 'username' => $user->username, 'email' => $user->email, 'countryname' => $country->countryname, 'statename' => $state->statename, 'cityname' => $city->cityname, 'role' => $role->role, 'status' => $status);
            endforeach;
            return array('status' => true, 'data' => $dataxls);
        } else {
            return array('status' => false, 'data' => 'No Data Found');
        }
    }

    public function actionUpdate($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $employee = RegisterUser::find()->where(['id' => $id])->one();
        $user_pswd = $employee->password;
        //echo '<pre>';print_r($employee);die;
        $employee->scenario = 'user_update';
        $employee->attributes = \Yii::$app->request->post();
        if (!empty($_POST['countryname'])):
            $country = Country::find()->where(['countryname' => $_POST['countryname']])->one();
            if (!empty($country)):
                $employee->country = $country->id;
                if (!empty($_POST['statename'])):
                    $state = State::find()->where(['statename' => $_POST['statename'], 'country_id' => $country->id])->one();
                    if (!empty($state)):
                        $employee->state = $state->id;
                        if (!empty($_POST['cityname'])):
                            $city = City::find()->where(['cityname' => $_POST['cityname'], 'country_id' => $country->id, 'state_id' => $employee->state])->one();
                            if (!empty($city)):
                                $employee->city = $city->id;
                            else:
                                return array('status' => false, 'error' => 'No such City exists');
                            endif;
                        endif;
                    else:
                        return array('status' => false, 'error' => 'No such State exists');
                    endif;
                endif;
            else:
                return array('status' => false, 'error' => 'No such country exists');
            endif;
        endif;
        if (!empty($_POST['statename'])):
            $state = State::find()->where(['statename' => $_POST['statename'], 'country_id' => $employee->country])->one();
            if (!empty($state)):
                $employee->state = $state->id;
            else:
                return array('status' => false, 'error' => 'No such State exists in this country.');
            endif;
        endif;
        if (!empty($_POST['cityname'])):
            $city = City::find()->where(['cityname' => $_POST['cityname'], 'country_id' => $employee->country, 'state_id' => $employee->state])->one();
            if (!empty($city)):
                $employee->city = $city->id;
            else:
                return array('status' => false, 'error' => 'No such City exists.');
            endif;
        endif;
        if ($employee->validate()) {
            $role = Role::findOne($employee->role);
            if (empty($role)):
                return array('status' => false, 'error' => 'now such role exists');
            endif;
            if ($employee->password == ''): //Password not updated Case
                $employee->password = $user_pswd;
            else: //Password updated Case
                $employee->setPassword($employee->password);
            endif;
            $employee->status = 1;
            $employee->updated = time();
            $employee->save(false);
            return array('status' => true, 'data' => 'data updated successfully');
        } else {
            return array('status' => false, 'error' => $employee->getErrors());
        }
    }

    public function actionDelete($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $employee = RegisterUser::find()->where(['id' => $id])->one();
        if ($employee->validate()) {
            $employee->delete();
            return array('status' => true, 'data' => 'data deleted successfully');
        } else {
            return array('status' => false, 'error' => $employee->getErrors());
        }
    }

    public function actionAddCountry() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $country = new Country();
        $country->scenario = 'create';
        $country->attributes = \Yii::$app->request->post();
        if ($country->validate()) {
            $country->created = time();
            $country->updated = time();
            $country->save(false);
            return array('status' => true, 'data' => 'Country added successfully');
        } else {
            return array('status' => false, 'error' => $country->getErrors());
        }
    }

    public function actionUpdateCountry($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $country = Country::findOne($id);
        $country->scenario = 'update';
        $country->attributes = \Yii::$app->request->post();
        if ($country->validate()) {
            $country->updated = time();
            $country->save(false);
            return array('status' => true, 'data' => 'Country Updated successfully');
        } else {
            return array('status' => false, 'error' => $country->getErrors());
        }
    }

    public function actionCountryList() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $country = Country::find()->all();
        $count = Country::find()->count();
        if ($count > 0) {
            return array('status' => true, 'data' => $country);
        } else {
            return array('status' => false, 'data' => 'No Data Found');
        }
    }

    public function actionDeleteCountry($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $country = Country::find()->where(['id' => $id])->one();
        if (!empty($country)) {
            $country->delete();
            return array('status' => true, 'data' => 'Country deleted successfully');
        } else {
            return array('status' => false, 'error' => 'No such Country exists');
        }
    }

    public function actionAddRole() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $role = new Role();
        $role->scenario = 'create';
        $role->attributes = \Yii::$app->request->post();
        if ($role->validate()) {
            $role->created = time();
            $role->updated = time();
            $role->save(false);
            return array('status' => true, 'data' => 'Role added successfully');
        } else {
            return array('status' => false, 'error' => $role->getErrors());
        }
    }

    public function actionUpdateRole($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $role = Role::findOne($id);
        $role->scenario = 'update';
        $role->attributes = \Yii::$app->request->post();
        if ($role->validate()) {
            $role->updated = time();
            $role->save(false);
            return array('status' => true, 'data' => 'Role Updated successfully');
        } else {
            return array('status' => false, 'error' => $role->getErrors());
        }
    }

    public function actionRoleList() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $role = Role::find()->all();
        $count = Role::find()->count();
        if ($count > 0) {
            return array('status' => true, 'data' => $role);
        } else {
            return array('status' => false, 'data' => 'No Data Found');
        }
    }

    public function actionDeleteRole($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $role = Role::find()->where(['id' => $id])->one();
        if (!empty($role)) {
            $role->delete();
            return array('status' => true, 'data' => 'Role deleted successfully');
        } else {
            return array('status' => false, 'error' => 'No such Role exists');
        }
    }

    public function actionAddState() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $state = new State();
        $state->scenario = 'apicreate';
        $state->attributes = \Yii::$app->request->post();
        if (!empty($state->countryname)):
            $country = Country::find()->where(['countryname' => $state->countryname])->one();
            if (!empty($country)):
                $state->country_id = $country->id;
            else:
                return array('status' => false, 'error' => 'No such country exists');
            endif;
        endif;
        if ($state->validate()) {
            $state->created = time();
            $state->updated = time();
            $state->save(false);
            return array('status' => true, 'data' => 'State added successfully');
        } else {
            return array('status' => false, 'error' => $state->getErrors());
        }
    }

    public function actionUpdateState($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $state = State::findOne($id);
        $state->scenario = 'apiupdate';
        $state->attributes = \Yii::$app->request->post();
        if (!empty($state->countryname)):
            $country = Country::find()->where(['countryname' => $state->countryname])->one();
            if (!empty($country)):
                $state->country_id = $country->id;
            else:
                return array('status' => false, 'error' => 'No such country exists');
            endif;
        endif;
        if ($state->validate()) {
            $state->updated = time();
            $state->save(false);
            return array('status' => true, 'data' => 'State Updated successfully');
        } else {
            return array('status' => false, 'error' => $state->getErrors());
        }
    }

    public function actionStateList() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $states = State::find()->all();
        $count = State::find()->count();
        if ($count > 0) {
            $role = [];
            foreach ($states as $state):
                $country = Country::findOne($state->country_id);
                $dataxls[] = array('id' => $state->id, 'countryname' => $country->countryname, 'statename' => $state->statename);
            endforeach;
            return array('status' => true, 'data' => $dataxls);
        } else {
            return array('status' => false, 'data' => 'No Data Found');
        }
    }

    public function actionDeleteState($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $role = State::find()->where(['id' => $id])->one();
        if (!empty($role)) {
            $role->delete();
            return array('status' => true, 'data' => 'State deleted successfully');
        } else {
            return array('status' => false, 'error' => 'No such State exists');
        }
    }

    public function actionAddCity() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $city = new City();
        $city->attributes = \Yii::$app->request->post();
        if (!empty($_POST['countryname'])):
            $country = Country::find()->where(['countryname' => $_POST['countryname']])->one();
            if (!empty($country)):
                $city->country_id = $country->id;
                if (!empty($_POST['statename'])):
                    $state = State::find()->where(['statename' => $_POST['statename'], 'country_id' => $country->id])->one();
                    if (!empty($state)):
                        $city->state_id = $state->id;
                    else:
                        return array('status' => false, 'error' => 'No such State exists');
                    endif;
                endif;
            else:
                return array('status' => false, 'error' => 'No such country exists');
            endif;
        endif;
        if ($city->validate()) {
            $city->created = time();
            $city->updated = time();
            $city->save(false);
            return array('status' => true, 'data' => 'City added successfully');
        } else {
            return array('status' => false, 'error' => $city->getErrors());
        }
    }

    public function actionUpdateCity($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $city = City::findOne($id);
        $city->attributes = \Yii::$app->request->post();
        if (!empty($_POST['countryname'])):
            $country = Country::find()->where(['countryname' => $_POST['countryname']])->one();
            if (!empty($country)):
                $city->country_id = $country->id;
                if (!empty($_POST['statename'])):
                    $state = State::find()->where(['statename' => $_POST['statename'], 'country_id' => $country->id])->one();
                    if (!empty($state)):
                        $city->state_id = $state->id;
                    else:
                        return array('status' => false, 'error' => 'No such State exists');
                    endif;
                endif;
            else:
                return array('status' => false, 'error' => 'No such State exists in this country.');
            endif;
        endif;
        if (!empty($_POST['statename'])):
            $state = State::find()->where(['statename' => $_POST['statename'], 'country_id' => $city->country_id])->one();
            if (!empty($state)):
                $city->state_id = $state->id;
            else:
                return array('status' => false, 'error' => 'No such State exists in this country.');
            endif;
        endif;
        if ($city->validate()) {
            $city->updated = time();
            $city->save(false);
            return array('status' => true, 'data' => 'City Updated successfully');
        } else {
            return array('status' => false, 'error' => $city->getErrors());
        }
    }

    public function actionCityList() {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $cities = City::find()->all();
        $count = City::find()->count();
        if ($count > 0) {
            $role = [];
            foreach ($cities as $city):
                $country = Country::findOne($city->country_id);
                $state = State::findOne($city->state_id);
                $dataxls[] = array('id' => $city->id, 'countryname' => $country->countryname, 'statename' => $state->statename, 'cityname' => $city->cityname);
            endforeach;
            return array('status' => true, 'data' => $dataxls);
        } else {
            return array('status' => false, 'data' => 'No Data Found');
        }
    }

    public function actionDeleteCity($id) {
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $role = City::find()->where(['id' => $id])->one();
        if (!empty($role)) {
            $role->delete();
            return array('status' => true, 'data' => 'City deleted successfully');
        } else {
            return array('status' => false, 'error' => 'No such City exists');
        }
    }

}
