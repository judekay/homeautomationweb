<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "{{%post_types}}".
 *
 * @property string $post_type_id
 * @property string $post_type
 * @property integer $active_status
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Posts[] $posts
 */
class PostTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_types}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_type', 'created_at', 'modified_at'], 'required'],
            [['active_status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['post_type'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_type_id' => 'Post Type ID',
            'post_type' => 'Post Type',
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
        return $this->hasMany(Posts::className(), ['post_type_id' => 'post_type_id']);
    }
}
