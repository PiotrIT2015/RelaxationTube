<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html; 

AppAsset::register($this);
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div class="wrap h-100 d-flex flex-column">

<?php echo $this->render('_header') ?>

<main role="main" class="d-flex">
<?php echo $this->render('_sidebar') ?>
    <div class="content-wrapper p-3">
        <?= Alert::widget() ?>
        <?= $content ?> 
    </div>
</main>

</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
