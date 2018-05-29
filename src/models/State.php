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
            [['country_id', 'created', 'updated'], 'integer'],
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

}
