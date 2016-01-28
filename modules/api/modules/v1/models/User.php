<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $user_id
 * @property string $user_type_id
 * @property string $username
 * @property string $password
 * @property string $access_token
 * @property string $firstname
 * @property string $lastname
 * @property string $created_at
 * @property string $modified_at
 * @property integer $active_status
 *
 * @property UserType $userType
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type_id', 'username', 'password', 'access_token', 'firstname', 'lastname', 'created_at', 'modified_at'], 'required'],
            [['user_type_id', 'active_status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['username', 'password', 'firstname', 'lastname'], 'string', 'max' => 50],
            [['access_token'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_type_id' => 'User Type ID',
            'username' => 'Username',
            'password' => 'Password',
            'access_token' => 'Access Token',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'active_status' => 'Active Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(UserType::className(), ['user_type_id' => 'user_type_id']);
    }


    public function getallUsers()
    {
        $users = User::find()->select(['user_id','user_type_id','(CASE WHEN(`user_type_id` = 1) THEN CONCAT("admin_user","")
                                                        ELSE CONCAT("primary_user", "")END) as `user_type_name`',
                                                        'username','firstname', 'lastname','created_at'])
                            ->where('active_status = 1')->asArray()->all();

        return $users;
    }

    public function getUsersDetails($user_id)
    {
        $users = User::find()->select(['user_id','user_type_id','(CASE WHEN(`user_type_id` = 1) THEN CONCAT("admin_user","")
                                                        ELSE CONCAT("primary_user", "")END) as `user_type_name`',
            'username','firstname', 'lastname','created_at'])
            ->where('active_status = 1')->andWhere('user_id='.$user_id)->asArray()->one();

        return $users;
    }

    public function removeuser($user_id)
    {
        $user = User::findOne($user_id);
        $user->active_status = 0;
        $user->update();
    }
    public function changepassword($user_id, $password)
    {
        $user = User::findOne($user_id);
        $user->password = $password;
        $user->update();
    }
}
