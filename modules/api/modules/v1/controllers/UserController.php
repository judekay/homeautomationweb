<?php

namespace app\modules\api\modules\v1\controllers;


use app\modules\api\common\models\ApiUtility;
use app\modules\api\modules\v1\models\ApiKeyHelper;
use app\modules\api\modules\v1\models\UserType;
use app\modules\api\modules\v1\models\UserTypeApiKeyHelper;
use app\modules\api\modules\v1\models\UserApiKeyHelper;
use app\modules\api\modules\v1\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\base\Exception;
use yii\helpers\ArrayHelper;


class UserController extends BaseController
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
       $params = $_REQUEST;
        $access_token = ApiKeyHelper::ACCESS_TOKEN;

        $usermodel = new User();

        $getallusers = $usermodel->getallUsers();
        if(empty($getallusers || !is_array($getallusers))){
            $message = "Error retrieving users";
            return ApiUtility::errorResponse($message);
        }
        else {
            $this->setHeader(200);
            return [
                'status' => true,
                'message' => 'All users fetched successfully',
                'data' => $getallusers

            ];
        }

    }

    public function actionUserdetails()
    {
        $params = $_REQUEST;
        $access_token = ApiKeyHelper::ACCESS_TOKEN;

        $user_id = Yii::$app->getRequest()->getQueryParam('user_id');
        $usermodel = new User();

        $getuser = $usermodel->getUsersDetails($user_id);
        if(empty($getuser || !is_array($getuser))){
            $message = "Error retrieving users";
            return ApiUtility::errorResponse($message);
        }
        else {
            $this->setHeader(200);
            return [
                'status' => true,
                'message' => 'User details fetched successfully',
                'data' => $getuser

            ];
        }

    }

    public function actionRegister()
    {
        $params = $_REQUEST;

        $access_token = ApiKeyHelper::ACCESS_TOKEN;

        $paramValuePair = [
            UserTypeApiKeyHelper::USER_TYPE_ID => ApiUtility::TYPE_INT,
            UserApiKeyHelper::USERNAME => ApiUtility::TYPE_STRING,
            UserApiKeyHelper::PASSWORD => ApiUtility::TYPE_STRING,
            UserApiKeyHelper::FIRSTNAME => ApiUtility::TYPE_STRING,
            UserApiKeyHelper::LASTNAME => ApiUtility::TYPE_STRING
        ];

        $this->paramCheck($paramValuePair, $params);

        $user_type_id = $params[UserTypeApiKeyHelper::USER_TYPE_ID];
        $username = $params[UserApiKeyHelper::USERNAME];
        $password = $params[UserApiKeyHelper::PASSWORD];
        $firstname = $params[UserApiKeyHelper::FIRSTNAME];
        $lastname = $params[UserApiKeyHelper::LASTNAME];
        $user_access_token = ApiUtility::generateAccessToken();
        $datetime = date('Y-m-d H:m:s');

        if($user_type_id != "" && $username != ""
            && $password != "" && $firstname != ""
            && $lastname != "")
        {
            $user_model = new User();

            $user_model->user_type_id = $user_type_id;
            $user_model->username = $username;
            $user_model->password = ApiUtility::generatePasswordHash($password);
            $user_model->firstname = $firstname;
            $user_model->lastname = $lastname;
            $user_model->access_token = $user_access_token;
            $user_model->created_at = $datetime;
            $user_model->modified_at = $datetime;

            if($user_model->save()){

                $this->setHeader(200);

                return [
                    'status' => true,
                    'message' => 'registration successful',
                    'user_api_key' => $user_access_token
                ];
            }
            else{
                $errormessage = "Error creating account please check parameter";
                return ApiUtility::errorResponse($errormessage);
            }

        }
        else{
            $errormessage = "username, password, firstname, lastname,usertype has to be set";
            return ApiUtility::errorResponse($errormessage);

        }

    }
    public function actionLogin()
    {
        $access_token = ApiKeyHelper::ACCESS_TOKEN;

        $params = $_REQUEST;

        $paramsValuePair = [

            UserApiKeyHelper::USERNAME => ApiUtility::TYPE_STRING,
            UserApiKeyHelper::PASSWORD => ApiUtility::TYPE_STRING,
        ];

        $this->paramCheck($paramsValuePair, $params);


        $username = $params[UserApiKeyHelper::USERNAME];
        $password = $params[UserApiKeyHelper::PASSWORD];

        if ($username == '' && $password == '') {
            return ApiUtility::errorResponse('Fill in the required fields');
        }

        $userModel = User::find()->where(['username' => $username])
            ->andWhere(['password' => ApiUtility::generatePasswordHash($password)])
            ->andWhere(['active_status' => 1])
            ->one();


        if ($userModel != null) {
            $this->setHeader(200);

            return [
                'status' => true,
                'data' => array(
                    'access_token' => $userModel->access_token,
                    'username' => $userModel->username,
                    'firstname' => $userModel->firstname,
                    'lastname' => $userModel->lastname,
                    'user_id' => $userModel->user_id,
                    'user_type_id' => $userModel->user_type_id,
                )
            ];
        } else {
            $error_msg = 'Username / Password incorrect';
            return ApiUtility::errorResponse($error_msg);
        }


    }


    public function actionDelete()
    {
        $params = $_REQUEST;
        $access_token = ApiKeyHelper::ACCESS_TOKEN;



        $user_id =Yii::$app->getRequest()->getQueryParam('user_id');
        $user = new User();





        $user->removeuser($user_id);


        return [

            'status' => true,
            'data' => null,
            'message' => 'user deleted successfully'
        ];



    }

    public function actionChangepass()
    {
        $params = $_REQUEST;
        $access_token = ApiKeyHelper::ACCESS_TOKEN;

        $paramsValuePair = [

            UserApiKeyHelper::PASSWORD => ApiUtility::TYPE_STRING,
        ];

        $this->paramCheck($paramsValuePair, $params);


        $password = ApiUtility::generatePasswordHash($params[UserApiKeyHelper::PASSWORD]);


        $user_id =Yii::$app->getRequest()->getQueryParam('user_id');
        $user = new User();





        $user->changepassword($user_id, $password);


        return [

            'status' => true,
            'data' => null,
            'message' => 'user password changed successfully'
        ];



    }






}
