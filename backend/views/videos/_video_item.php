<?php
/** @var $model \common\models\Videos */

use yii\helpers\StringHelper;
use yii\helpers\Url;
?>

<div class="media">
    <a href="<?php echo Url::to(['/videos/update','id'=>$model->video_id])?>">
        <div class="embed-responsive embed-responsive-16by9 mr-2" style="width: 120px">
            <video class="embeded-responsive-item" 
            poster="<?php echo $model->getThumbnailLink() ?>"
            src="<?php echo $model->getVideoLink() ?>" ></video>
        </div>
    </a>
    <div class="media-body">
        <h6 class="mt-0"><?php echo $model->title ?></h6>
        <?php echo StringHelper::truncateWords($model->description, 10)?>
    </div>
</div>