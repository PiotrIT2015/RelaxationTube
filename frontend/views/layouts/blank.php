<?php

/** @var \yii\web\View $this */
/** @var string $content */


use common\widgets\Alert;

$this->beginContent('@frontend/views/layouts/base.php');
?>

<div class="wrap h-100 d-flex flex-column">

<?php echo $this->render('_header') ?>

<main role="main" class="d-flex">

    <div class="content-wrapper p-3">
        <?= Alert::widget() ?>
        <?= $content ?> 
    </div>
</main>

</div>


<?php $this->endContent()?>
