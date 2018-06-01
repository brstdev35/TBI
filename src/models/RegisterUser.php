<?php

namespace TBI\Login\models;

use Yii;
use yii\validators\EmailValidator;

/**
 * This is the model class for table "register_user".
 *
 * @property string $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $access_token
 * @property string $profile_pic
 * @property integer $status
 * @property string $created
 * @property string $updated
 */
class RegisterUser extends \yii\db\ActiveRecord {

    public $confirm_password;
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'register_user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['email', 'password', 'confirm_password', 'status', 'username', 'firstname', 'lastname', 'country', 'city', 'state','role','gender','pincode','address','dob'], 'required', 'on' => 'user_signup'],
            [['created', 'updated','pincode'], 'integer'],
            [['email'], 'validateEmail', 'on' => 'user_signup'],
            [['email'], 'validateupdateEmail', 'on' => 'user_update'],
            ['password', 'string', 'min' => 6],
            ['pincode', 'string', 'min' => 6,'max' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            [['firstname', 'lastname', 'email', 'access_token', 'profile_pic'], 'string', 'max' => 255],
            [['email', 'status', 'username', 'firstname', 'lastname', 'country', 'city', 'state','role','gender','pincode','address','dob'], 'required', 'on' => 'user_update'],
            ['confirm_password', 'required', 'when' => function ($model) {
                    return $model->password !== '';
                }, 'whenClient' => "function (attribute, value) {
                return $('#registeruser-password').val() !== '';
                }",
                'on' => 'user_update'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'password' => 'Password',
            'access_token' => 'Access Token',
            'profile_pic' => 'Profile Pic',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'role' => 'Role',
            'dob' => 'Date of Birth',
            'pincode' => 'Pincode',
            'address' => 'Address',
            'gender' => 'Gender',
        ];
    }

    public function setPassword($password) {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function validateEmail($attribute, $params, $validator) {
        $email = trim($this->$attribute, ' ');
        $validator = new EmailValidator();
        if (!($validator->validate($email, $error))) {
            $this->addError($attribute, 'Email is not a valid email address.');
        }
        $email1 = RegisterUser::find()->where(['email' => $email])->all();
        if (!empty($email1)) {
            $this->addError($attribute, 'This email address is already registered.');
        }
    }
    
    public function validateupdateEmail($attribute, $params, $validator) {
        $id =$_GET['id'];
        $email = trim($this->$attribute, ' ');
        $validator = new EmailValidator();
        if (!($validator->validate($email, $error))) {
            $this->addError($attribute, 'Email is not a valid email address.');
        }
        $email1 = RegisterUser::find()->where(['email' => $email])->andWhere(['!=','id',$id])->all();
        if (!empty($email1)) {
            $this->addError($attribute, 'This email address is already registered.');
        }
    }

}
