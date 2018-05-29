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
            [['status', 'created', 'updated'], 'integer'],
            [['firstname', 'lastname', 'email', 'password', 'access_token', 'profile_pic'], 'string', 'max' => 255],
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

}
