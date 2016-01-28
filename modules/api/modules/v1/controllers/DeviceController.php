<?php

namespace app\modules\api\modules\v1\controllers;

use app\modules\api\common\models\ApiUtility;
use app\modules\api\modules\v1\models\ApiKeyHelper;
use app\modules\api\modules\v1\models\Device;
use app\modules\api\modules\v1\models\DeviceApiKeyHelper;
use Yii;
use yii\filters\VerbFilter;
use yii\base\Exception;
use yii\helpers\ArrayHelper;


class DeviceController extends BaseController
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['post'],
                    'register' => ['post'],

                ],
            ],
        ]);
    }
    public function actionIndex()
    {
       return json_encode('kayode');
    }

    public function actionTurnonoff()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;


        $paramsValuePair = [DeviceApiKeyHelper::DEVICE_VALUE => ApiUtility::TYPE_INT];

        $this->paramCheck($paramsValuePair, $params);



        $device_value = $params[DeviceApiKeyHelper::DEVICE_VALUE];
        $datetime = date('Y-m-d H:m:s');

        $device = new Device();

        $device_id = Yii::$app->getRequest()->getQueryParam('device_id');

        $device->changeBulb($device_id, $device_value, $datetime);


            $this->setHeader(200);
            return[
                'status' => true,
                'message'=> 'device state updated successfully',
                'device_id' => $device_id
            ];

    }

    public function actionRotatefan()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;


        $paramsValuePair = [DeviceApiKeyHelper::DEVICE_VALUE => ApiUtility::TYPE_INT];

        $this->paramCheck($paramsValuePair, $params);



        $device_value = $params[DeviceApiKeyHelper::DEVICE_VALUE];
        $datetime = date('Y-m-d H:m:s');

        $device = new Device();

        $device_id = Yii::$app->getRequest()->getQueryParam('device_id');

        $dev = $device->changeFan($device_id, $device_value, $datetime);



        if($dev == true){

            $this->setHeader(200);
            return[
                'status' => true,
                'message'=> 'Fan state updated successfully',
                'device_id' => $device_id
            ];
        }
        else{
            $errormessage = "Error, Device could not be updated";
            return ApiUtility::errorResponse($errormessage);
        }



    }

    public function actionDevicestate()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;

        $device_id = Yii::$app->getRequest()->getQueryParam('device_id');
        $device = new Device();
        $devicestate = $device->getdevicevaluebyid($device_id);
        if(empty($devicestate || !is_array($devicestate))){
            $message = "Device State could not be retrieved";
            return ApiUtility::errorResponse($message);
        }
        else {
            $this->setHeader(200);
            return [
                'status' => true,
                'message' => 'Device state fetched successfully',
                'data' => $devicestate

            ];
        }

    }

    public function actionDevicestategroup()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;

        $device_id = Yii::$app->getRequest()->getQueryParam('device_group');
        $device = new Device();
        $devicestate = $device->getdevicevalbygroupid($device_id);
        if(empty($devicestate || !is_array($devicestate))){
            $message = "Device State could not be retrieved";
            return ApiUtility::errorResponse($message);
        }
        else {
            $this->setHeader(200);
            return [
                'status' => true,
                'message' => 'Device state fetched successfully',
                'data' => $devicestate

            ];
        }

    }


//    public function actionGetdevgrpdet()
//    {
//        $params = $_REQUEST;
//
//        $access_token = ApiKeyHelper::ACCESS_TOKEN;
//
//
//        $device = new Device();
//        $devicestate = $device->fetchallgroupdetails();
//        if(empty($devicestate || !is_array($devicestate))){
//            $message = "Device Count retrieved successfully";
//            return ApiUtility::errorResponse($message);
//        }
//        else {
//            $this->setHeader(200);
//            return [
//                'status' => true,
//                'message' => 'Device count fetched successfully',
//                'data' => $devicestate
//
//            ];
//        }
//
//
//
//    }


    public function actionDelete()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;




        $device = new Device();

        $device_id = Yii::$app->getRequest()->getQueryParam('device_id');

        $device->DeleteDevice($device_id);


        $this->setHeader(200);
        return[
            'status' => true,
            'message'=> 'device deleted successfully',

        ];

    }

    public function actionChangedevicename()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;


        $paramsValuePair = [DeviceApiKeyHelper::DEVICE_NAME => ApiUtility::TYPE_STRING];

        $this->paramCheck($paramsValuePair, $params);



        $device_name = $params[DeviceApiKeyHelper::DEVICE_NAME];
        $datetime = date('Y-m-d H:m:s');

        $device = new Device();

        $device_id = Yii::$app->getRequest()->getQueryParam('device_id');

        $device->changeDevicename($device_id, $device_name, $datetime);


        $this->setHeader(200);
        return[
            'status' => true,
            'message'=> 'device name updated successfully',
            'device_id' => $device_id
        ];

    }


}
