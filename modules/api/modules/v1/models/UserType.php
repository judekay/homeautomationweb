<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "user_type".
 *
 * @property string $user_type_id
 * @property string $user_type_name
 * @property string $created_at
 * @property string $modified_at
 * @property integer $active_status
 *
 * @property User[] $users
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type_name', 'created_at', 'modified_at'], 'required'],
            [['created_at', 'modified_at'], 'safe'],
            [['active_status'], 'integer'],
            [['user_type_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_type_id' => 'User Type ID',
            'user_type_name' => 'User Type Name',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'active_status' => 'Active Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_type_id' => 'user_type_id']);
    }
}
