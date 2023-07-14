<?php

use \yii\helpers\Url;

/**@var $model \common\models\Videos */
?>

<div class="row">
    <div class="col-sm-8">
        <div class="embed-responsive embed-responsive-16by9">
                <video class="embeded-responsive-item" 
                poster="<?php echo $model->getThumbnailLink() ?>"
                src="<?php echo $model->getVideoLink() ?>" controls></video>
            </div>
            <h6 class="mt-2"><?php echo $model->title ?></h6>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <?php echo $model->getViews()->count()?> views ⚫ <?php echo Yii::$app->formatter->asDate($model->created_at) ?>
                </div>
                <div>
                    <?php \yii\widgets\Pjax::begin() ?>
                    <?php echo $this->render('_buttons', [
                        'model' => $model
                    ]) ?>
                    <?php \yii\widgets\Pjax::end() ?>
                </div>
            </div>
        <div>
            <p>
                <?php echo \yii\helpers\Html::a($model->createdBy->username, [
                    '/channel/view', 'username' => $model->createdBy->username
                ]) ?>
            </p>
            <?php echo \yii\helpers\Html::encode($model->description) ?>
        </div>
    </div>
    <div class="col-sm-4">

    </div>
</div>