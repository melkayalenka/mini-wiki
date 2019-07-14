<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="site-about">
    <h1><?= Html::encode($model->title) ?></h1>

    <p><?= Html::decode($model->body) ?></p>
    <div class="col-lg-11">
        <?= Html::a("<p>Редактировать</p>", Url::to(['update', 'id'=>$model->id]) ) ?>
    </div>

</div>
