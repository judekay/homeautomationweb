<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/18/15
 * Time: 9:01 PM
 */

return [
    'api/v1/user/userdetails/<user_id:\d+>' => 'api/v1/user/userdetails',
    'api/v1/user/delete/<user_id:\d+>' => 'api/v1/user/delete',
    'api/v1/user/changepass/<user_id:\d+>' => 'api/v1/user/changepass',
    'api/v1/device/turnonoff/<device_id:\d+>' => 'api/v1/device/turnonoff',
    'api/v1/device/rotatefan/<device_id:\d+>' => 'api/v1/device/rotatefan',
    'api/v1/device/devicestate/<device_id:\d+>' => 'api/v1/device/devicestate',
    'api/v1/device/devicestategroup/<device_group:\d+>' => 'api/v1/device/devicestategroup',
    'api/v1/device/delete/<device_id:\d+>' => 'api/v1/device/delete',
    'api/v1/device/changedevicename/<device_id:\d+>' => 'api/v1/device/changedevicename',
    'api/v1/device-group/getcount/<device_group_id:\d+>' => 'api/v1/device-group/getcount',
];