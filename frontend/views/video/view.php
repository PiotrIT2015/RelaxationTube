<?php

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
                    123 views . <?php echo Yii::$app->formatter->asDate($model->created_at) ?>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="fa-regular fa-thumbs-up"></i> 9
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fa-regular fa-thumbs-down"></i> 3
                    </button>
                </div>
            </div>
    </div>
    <div class="col-sm-4">

    </div>
</div>