<?php

namespace TBI\Login\models;

use Yii;

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
            [['email', 'password', 'confirm_password', 'status', 'username', 'firstname', 'lastname', 'country', 'city', 'state'], 'required', 'on' => 'user_signup'],
            [['created', 'updated'], 'integer'],
            [['email'], 'email'],
            [['email'], 'unique'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            [['firstname', 'lastname', 'email', 'access_token', 'profile_pic'], 'string', 'max' => 255],
            [['email', 'status', 'username', 'firstname', 'lastname', 'country', 'city', 'state'], 'required', 'on' => 'user_update'],
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
        ];
    }

    public function setPassword($password) {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

}
