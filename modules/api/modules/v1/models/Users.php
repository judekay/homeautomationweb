<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property string $user_id
 * @property string $profile_id
 * @property string $username
 * @property string $password
 * @property string $access_token
 * @property string $verification_code
 * @property integer $active_status
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Posts[] $posts
 * @property Profiles $profile
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'username', 'password', 'access_token', 'verification_code', 'created_at', 'modified_at'], 'required'],
            [['profile_id', 'active_status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['username'], 'string', 'max' => 40],
            [['password', 'access_token'], 'string', 'max' => 100],
            [['verification_code'], 'string', 'max' => 200],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profiles::className(), 'targetAttribute' => ['profile_id' => 'profile_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'profile_id' => 'Profile ID',
            'username' => 'Username',
            'password' => 'Password',
            'access_token' => 'Access Token',
            'verification_code' => 'Verification Code',
            'active_status' => 'Active Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profiles::className(), ['profile_id' => 'profile_id']);
    }
}
