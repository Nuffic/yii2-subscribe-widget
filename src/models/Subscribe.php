<?php

namespace nuffic\subscribe\models;

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

    private function sendToInterspire($model) {

    }
}
