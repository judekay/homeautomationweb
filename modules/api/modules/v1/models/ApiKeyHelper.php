<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/18/15
 * Time: 9:21 PM
 */
namespace app\modules\api\modules\v1\models;

class ApiKeyHelper {
    CONST ACCESS_TOKEN = "access_token";
    CONST PAGE = "page";
    CONST FILTER = "filter";
    CONST LIMIT = "limit";
    CONST LAST_ID = "last_id";
}

class DeviceApiKeyHelper extends ApiKeyHelper {
    CONST DEVICE_ID = "device_id";
    CONST DEVICE_NAME = "device_name";
    CONST DEVICE_VALUE = "device_value";
}

class DeviceTypeApiKeyHelper extends ApiKeyHelper{
    CONST DEVICE_TYPE_ID = "device_type_id";
    CONST DEVICE_TYPE_NAME = "device_type_name";

}

class DeviceGroupApiKeyHelper extends  ApiKeyHelper{
    CONST DEVICE_GROUP_ID = "device_group_id";
    CONST DEVICE_GROUP_NAME = "device_group_name";
    CONST DEVICE_GROUP_DETAIL = "device_group_detail";
    CONST TEMPERATURE_VALUE = "temperature_value";
}

class UserTypeApiKeyHelper extends ApiKeyHelper
{
    CONST USER_TYPE_ID = "user_type_id";
    CONST USER_TYPE_NAME = "user_type_name";
}

class UserApiKeyHelper extends ApiKeyHelper
{
    CONST USER_ID = "user_id";
    CONST USERNAME = "username";
    CONST FIRSTNAME = "firstname";
    CONST LASTNAME = "lastname";
    CONST PASSWORD = "password";

}
