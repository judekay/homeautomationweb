<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "{{%memberships}}".
 *
 * @property string $membership_id
 * @property string $membership_type
 * @property integer $active_status
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Profiles[] $profiles
 */
class Memberships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%memberships}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['membership_type', 'created_at', 'modified_at'], 'required'],
            [['active_status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['membership_type'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'membership_id' => 'Membership ID',
            'membership_type' => 'Membership Type',
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
        return $this->hasMany(Profiles::className(), ['membership_id' => 'membership_id']);
    }
}
