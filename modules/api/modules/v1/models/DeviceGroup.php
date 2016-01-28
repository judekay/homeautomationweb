<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "device_group".
 *
 * @property string $device_group_id
 * @property string $device_group_name
 * @property integer $temperature_value
 * @property string $device_group_details
 * @property string $created_at
 * @property string $modified_at
 * @property integer $active_status
 *
 * @property Device[] $devices
 */
class DeviceGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_group_name', 'device_group_details', 'created_at', 'modified_at'], 'required'],
            [['temperature_value', 'active_status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['device_group_name'], 'string', 'max' => 100],
            [['device_group_details'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_group_id' => 'Device Group ID',
            'device_group_name' => 'Device Group Name',
            'temperature_value' => 'Temperature Value',
            'device_group_details' => 'Device Group Details',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'active_status' => 'Active Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasMany(Device::className(), ['device_group_id' => 'device_group_id']);
    }

    public function countgroupdevices($device_group_id)
    {
        $device = Device::find()->select(['count(device_id) AS device_id'])->where(['device_group_id'=> $device_group_id])
            ->andWhere(['active_status'=> 1])
            ->asArray()->all();

        return $device;
    }

    public function fetchallgroupdetails()
    {
        $db = Yii::$app->db;
        $sql = "SELECT device_group.device_group_id, count(device.device_group_id) AS no_of_devices, device_group.device_group_name
                         FROM device INNER JOIN device_group  WHERE device.device_group_id = device_group.device_group_id GROUP BY device.device_group_id";
        $command = $db->createCommand($sql);
        return $command->queryAll();


    }


}
