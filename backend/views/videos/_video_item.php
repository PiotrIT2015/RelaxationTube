<?php
/** @var $model \common\models\Videos */

use yii\helpers\StringHelper;
?>

<div class="media">
    <div class="embed-responsive embed-responsive-16by9 mr-2" style="width: 120px">
        <video class="embeded-responsive-item" 
        poster="<?php echo $model->getThumbnailLink() ?>"
        src="<?php echo $model->getVideoLink() ?>" ></video>
    </div>
    <div class="media-body">
        <h6 class="mt-0"><?php echo $model->title ?></h6>
        <?php echo StringHelper::truncateWords($model->description, 10)?>
    </div>
</div>