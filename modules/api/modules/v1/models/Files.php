<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "{{%files}}".
 *
 * @property string $file_id
 * @property string $post_id
 * @property string $file_name
 * @property integer $active_status
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Posts $post
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'file_name', 'created_at', 'modified_at'], 'required'],
            [['post_id', 'active_status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['file_name'], 'string', 'max' => 40],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'post_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'post_id' => 'Post ID',
            'file_name' => 'File Name',
            'active_status' => 'Active Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['post_id' => 'post_id']);
    }
}
