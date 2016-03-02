<?php

namespace app\modules\api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property string $device_id
 * @property string $device_type_id
 * @property string $device_group_id
 * @property string $device_name
 * @property string $device_value
 * @property string $created_at
 * @property string $modified_at
 * @property integer $active_status
 *
 * @property DeviceType $deviceType
 * @property DeviceGroup $deviceGroup

 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_type_id', 'device_group_id', 'device_name', 'created_at', 'modified_at'], 'required'],
            [['device_type_id', 'device_group_id', 'device_value', 'active_status'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['device_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => 'Device ID',
            'device_type_id' => 'Device Type ID',
            'device_group_id' => 'Device Group ID',
            'device_name' => 'Device Name',
            'device_value' => 'Device Value',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'active_status' => 'Active Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceType()
    {
        return $this->hasOne(DeviceType::className(), ['device_type_id' => 'device_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceGroup()
    {
        return $this->hasOne(DeviceGroup::className(), ['device_group_id' => 'device_group_id']);
    }

    public function changeBulb($deviceid, $devicevalue, $datetime)
    {
        $device = Device::findOne($deviceid);

        $device->device_value = $devicevalue;
        $device->modified_at = $datetime;
        return $device->save();
    }

    public function changeFan($deviceid, $devicevalue, $datetime)
    {
        $device = Device::findOne($deviceid);
        $device->device_value = $devicevalue;
        $device->modified_at = $datetime;
        return $device->save();


    }

    public function getdevicevaluebyid($device_type_id)
    {
//        SELECT person_id, GROUP_CONCAT(hobbies SEPARATOR ', ')
//FROM peoples_hobbies GROUP BY person_id
//        replace('Your String','charater you want to replace','with what')
        $device = Device::findBySql("SELECT replace(GROUP_CONCAT(device_value),',','')as device_value FROM device WHERE device_type_id = $device_type_id")->asArray()->all();
        return $device;
    }


//return $files;
    public function getdevicevalbygroupid($device_group)
    {
        $device = Device::find()->select(['device_id','device_name','device_type_id', 'device_group.device_group_name',
                        'device_value','(CASE WHEN(`device_type_id` = 1) THEN CONCAT("BULB","")
                                                        ELSE CONCAT("FAN", "")END) as `device_type_name`'])
            ->innerJoinWith('deviceGroup', false)->where(['device.device_group_id'=> $device_group])
            ->andWhere(['device_group.active_status'=> 1, 'device.active_status'=> 1])
                        ->asArray()->all();

        return $device;
    }

    public function DeleteDevice($deviceid)
    {
        $device = Device::findOne($deviceid);
        $device->active_status = 0;

        return $device->save();


    }

    public function changeDevicename($deviceid, $devicename, $datetime)
    {
        $device = Device::findOne($deviceid);

        $device->device_name = $devicename;
        $device->modified_at = $datetime;
        return $device->save();
    }


}
