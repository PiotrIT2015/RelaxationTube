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

        <p>Przeciągnij i upuść pliki wideo, które chcesz przesłać
        <p>

        <p class="text-muted">Twoje filmy będą prywatne, dopóki ich nie opublikujesz.</p>

        <button class="btn btn-primary btn-file">
            Select File
            <input type="file" id="videoFile" name="video">
        </button>
    </div>

</div>
