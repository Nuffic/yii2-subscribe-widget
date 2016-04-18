<?php

namespace nuffic\subscribe\widgets;

use yii\base\Widget;
use yii\helpers\Url;

class Subscribe extends Widget
{

    public $controllerMapId = 'subscribe';

    public $action;

    public function init()
    {
        if (!$this->action) {
            $this->action = Url::to(['/' . $this->controllerMapId]);
        }
    }

    public function run()
    {
        $model = new \nuffic\subscribe\models\Subscribe();
        echo $this->render('form', ['model' => $model]);
    }
}
