<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Videos $model */

$this->title = 'Create Videos';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="upload-icon">
            <i class="fa-solid fa-upload fa-2xl" style="color: #1f5122;"></i>
        </div>
        <br>

        <p>Przeciągnij i upuść pliki wideo, które chcesz przesłać
        <p>

        <p class="text-muted">Twoje filmy będą prywatne, dopóki ich nie opublikujesz.</p>

        <?php $form = \yii\bootstrap4\ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]) ?>

        <div class="form-group">
            <?= $form->field($model, 'video')->fileInput(['id' => 'videoFile'])->label('Select File') ?>
        </div>

        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

        <?php \yii\bootstrap4\ActiveForm::end() ?>
    </div>

</div>
