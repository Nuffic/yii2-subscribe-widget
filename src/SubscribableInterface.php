<?php

namespace nuffic\subscribe;

use yii\base\Model;

interface SubscribableInterface
{

    /**
     * @param $model Model
     *
     * @return Model
     */
    public function subscribe(Model $model);
}
