<?php

namespace TBI\Login\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $statename
 * @property integer $created
 * @property integer $updated
 */
class State extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'state';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['country_id','statename'],'required'],
            [['country_id', 'created', 'updated'], 'integer'],
            [['statename'],'validateState','on' => 'create'],
            [['statename'],'validateupdateState','on' => 'update'],
            [['statename'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'statename' => 'Statename',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    public function validateState($attribute, $params, $validator) {
        $state = trim($this->$attribute, ' ');
        $country = Yii::$app->request->post()['State']['country_id'];
        $check = State::find()->where(['statename' => $state,'country_id' => $country])->all();
        if (!empty($check)) {
            $this->addError($attribute, 'State already Exists for this country');
        }
    }
    public function validateupdateState($attribute, $params, $validator) {
        $id = $_GET['id'];
        $state = trim($this->$attribute, ' ');
        $country = Yii::$app->request->post()['State']['country_id'];
        $check = State::find()->where(['statename' => $state,'country_id' => $country])->andWhere(['!=','id',$id])->all();
        if (!empty($check)) {
            $this->addError($attribute, 'State already Exists for this country');
        }
    }
}
