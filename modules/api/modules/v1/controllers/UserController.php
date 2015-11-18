<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/18/15
 * Time: 2:06 PM
 */

namespace app\modules\api\modules\v1\controllers;


use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class UserController extends BaseController{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],

                ],
            ],
        ]);
    }

    public function actionIndex(){

        return "mesh";
    }

} 