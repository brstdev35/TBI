<?php

namespace TBI\Login\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $countryname
 * @property integer $created
 * @property integer $updated
 */
class Country extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['created', 'updated'], 'integer'],
            [['countryname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'countryname' => 'Countryname',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

}
