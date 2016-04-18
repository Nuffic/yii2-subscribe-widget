<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
<?php Pjax::begin(['enablePushState' => false, 'id' => 'subscribe-widget']); ?>
<?php $form = ActiveForm::begin([
    'action' => ['/subscribe/create'],
    'options' => ['class' => 'form-inline', 'data-pjax' => ''],
]); ?>

<div class="input-group">
<?= Html::activeTextInput($model, 'email', ['class' => 'form-control subscribe-input', 'placeholder' => Yii::t('app', 'Type here...')]) ?>
    <span class="input-group-btn">
        <?= Html::submitButton(Yii::t('app', 'Subscribe'), ['class' => 'btn btn-subscribe']) ?>
    </span>
</div>
<?= Html::error($model, 'email') ?>
<?php ActiveForm::end() ?>
<?php Pjax::end();

