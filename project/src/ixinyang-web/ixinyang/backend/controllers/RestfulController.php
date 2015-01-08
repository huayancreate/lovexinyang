<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;


class RestfulController extends ActiveController
{
    public $modelClass = 'backend\models\TAdmUser';
}