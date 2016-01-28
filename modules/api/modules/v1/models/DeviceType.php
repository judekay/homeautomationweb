<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "device_type".
 *
 * @property string $device_type_id
 * @property string $device_type_name
 * @property string $created_at
 * @property string $modified_at
 * @property integer $active_status
 *
 * @property Device[] $devices
 */
class DeviceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_type_name', 'created_at', 'modified_at'], 'required'],
            [['created_at', 'modified_at'], 'safe'],
            [['active_status'], 'integer'],
            [['device_type_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_type_id' => 'Device Type ID',
            'device_type_name' => 'Device Type Name',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'active_status' => 'Active Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::className(), ['device_type_id' => 'device_type_id']);
    }
}
