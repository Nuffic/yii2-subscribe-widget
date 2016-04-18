<?php

namespace nuffic\subscribe\models;

use Yii;
use yii\base\Model;

class Subscribe extends Model
{

    public $email;

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
        ];
    }

    public function subscribe()
    {
        if (!$this->validate()) {
            return false;
        }

        $model =  Yii::$app->subscriber->subscribe($this);
        return !$model->getErrors();
    }
}
