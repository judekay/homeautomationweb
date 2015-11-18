<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "{{%posts}}".
 *
 * @property string $post_id
 * @property string $user_id
 * @property string $post_type_id
 * @property string $post_title
 * @property string $post_content
 * @property integer $active_status
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Comments[] $comments
 * @property Files[] $files
 * @property PostTypes $postType
 * @property Users $user
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post_type_id', 'post_title', 'post_content', 'created_at', 'modified_at'], 'required'],
            [['user_id', 'post_type_id', 'active_status'], 'integer'],
            [['post_content'], 'string'],
            [['created_at', 'modified_at'], 'safe'],
            [['post_title'], 'string', 'max' => 70],
            [['post_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostTypes::className(), 'targetAttribute' => ['post_type_id' => 'post_type_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'post_type_id' => 'Post Type ID',
            'post_title' => 'Post Title',
            'post_content' => 'Post Content',
            'active_status' => 'Active Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['post_id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostType()
    {
        return $this->hasOne(PostTypes::className(), ['post_type_id' => 'post_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }
}
