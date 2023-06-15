<?php

?>

<aside class="shadow">

<div class="jumbotron text-center bg-transparent">
        <div class="container">
            
<?php echo \yii\bootstrap4\Nav::widget([
    'options' => [
      'class' => 'd-flex flex-column nav-pills'
    ],
    'items' => [
      [
        'label' => 'Dashboard',
        'url' => ['/site/index']
      ],
      [
        'label' => 'Videos',
        'url' => ['/video/index']
      ]
    ]
])?>
          
      </div>
</div>

</aside>