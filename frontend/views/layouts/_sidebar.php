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
        'label' => 'Home',
        'url' => ['/site/index']
      ],
      [
        'label' => 'History',
        'url' => ['/videos/history']
      ]
    ]
])?>
          
      </div>
</div>

</aside>