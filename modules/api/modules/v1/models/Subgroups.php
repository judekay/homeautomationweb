<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "{{%subgroups}}".
 *
 * @property string $subgroup_id
 * @property string $subgroup_name
 * @property integer $active_status
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Profiles[] $profiles
 */
class Subgroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subgroups}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subgroup_name', 'created_at', 'modified_at'], 'required'],
            [['active_status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['subgroup_name'], 'string', 'max' => 50],
            [['subgroup_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subgroup_id' => 'Subgroup ID',
            'subgroup_name' => 'Subgroup Name',
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
        return $this->hasMany(Profiles::className(), ['subgroup_id' => 'subgroup_id']);
    }
}
