<?php

namespace nuffic\subscribe\senders;

use nuffic\sendsmaily\ApiClient;
use Yii;
use yii\base\Model;

class Sendsmaily extends ApiClient
{

    public $baseUrl;
    public $apiUser;
    public $apiPassword;
    public $params;

    public function subscribe(Model $model)
    {
        $result = $this->addSubscriber($model->email,(array) $this->params);

        if (strtoupper($result->message) == 'OK') {
            return $model;
        }

        $model->addError('email', Yii::t('app', 'Something went wrong'));
        return $model;
    }
}
