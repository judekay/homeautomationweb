<?php

namespace app\modules\api\modules\v1\controllers;

use app\modules\api\common\models\ApiUtility;
use app\modules\api\modules\v1\models\ApiKeyHelper;
use app\modules\api\modules\v1\models\DeviceGroup;
use app\modules\api\modules\v1\models\DeviceGroupApiKeyHelper;
use Yii;
use yii\filters\VerbFilter;
use yii\base\Exception;
use yii\helpers\ArrayHelper;



class DeviceGroupController extends BaseController
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
        return json_encode("kayode");
    }

    public function actionGetcount()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;

        $device_id = Yii::$app->getRequest()->getQueryParam('device_group_id');
        $device = new DeviceGroup();
        $devicestate = $device->countgroupdevices($device_id);
        if(empty($devicestate || !is_array($devicestate))){
            $message = "Device Count retrieved successfully";
            return ApiUtility::errorResponse($message);
        }
        else {
            $this->setHeader(200);
            return [
                'status' => true,
                'message' => 'Device count fetched successfully',
                'data' => $devicestate

            ];
        }



    }

    public function actionGetdevgrpdet()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;


        $device = new DeviceGroup();
        $devicestate = $device->fetchallgroupdetails();
        if(empty($devicestate || !is_array($devicestate))){
            $message = "Device Count retrieved successfully";
            return ApiUtility::errorResponse($message);
        }
        else {
            $this->setHeader(200);
            return [
                'status' => true,
                'message' => 'Device count fetched successfully',
                'data' => $devicestate

            ];
        }



    }


    public function actionGetondevcount()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;


        $device = new DeviceGroup();
        $devicestate = $device->fetchallgroupdetails();
        if(empty($devicestate || !is_array($devicestate))){
            $message = "Device Count retrieved successfully";
            return ApiUtility::errorResponse($message);
        }
        else {
            $this->setHeader(200);
            return [
                'status' => true,
                'message' => 'Device count fetched successfully',
                'data' => $devicestate

            ];
        }



    }

}
