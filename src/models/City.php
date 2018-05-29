<?php

namespace TBI\Login\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property integer $state_id
 * @property string $cityname
 * @property integer $created
 * @property integer $updated
 */
class City extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['state_id', 'created', 'updated'], 'integer'],
            [['cityname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'state_id' => 'State ID',
            'cityname' => 'Cityname',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

}
