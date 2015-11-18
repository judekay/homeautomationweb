<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "{{%users_type}}".
 *
 * @property string $user_type_id
 * @property string $user_type
 * @property integer $active_status
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Profiles[] $profiles
 */
class UsersType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type', 'created_at', 'modified_at'], 'required'],
            [['active_status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['user_type'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_type_id' => 'User Type ID',
            'user_type' => 'User Type',
            'active_status' => 'Active Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profiles::className(), ['user_type_id' => 'user_type_id']);
    }
}
