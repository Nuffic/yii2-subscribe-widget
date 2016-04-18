<?php

namespace nuffic\subscribe\controllers;

use nuffic\subscribe\models\Subscribe;
use Yii;
use yii\web\Controller;

class SubscribeController extends Controller
{
    public $layout = false;

    public function getViewPath()
    {
        return '@vendor/nuffic/yii2-subscribe/src/widgets/views';
    }

    public function actionCreate()
    {
        $model = new Subscribe();
        $model->load(Yii::$app->request->post());

        if ($model->subscribe()) {
            return $this->render('success');
        }
        return $this->render('form', ['model' => $model]);
    }
}
