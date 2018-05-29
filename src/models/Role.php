<?php

namespace TBI\Login\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $role
 * @property integer $created
 * @property integer $updated
 */
class Role extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['created', 'updated'], 'integer'],
            [['role'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }


}
