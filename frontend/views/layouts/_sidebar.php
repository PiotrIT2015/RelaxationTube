<?php

?>

<aside class="shadow">

<div class="jumbotron text-center bg-transparent">
        <div class="container">
            
<?php echo \yii\bootstrap4\Nav::widget([
    'options' => [
      'class' => 'd-flex flex-column nav-pills'
    ],
    'encodeLabels' => false, 
    'items' => [
      [
        'label' => '<i class="fa-solid fa-house" style="color: #2c511f;"></i> Home',
        'url' => ['/video/index']
      ],
      [
        'label' => '<i class="fa-solid fa-clock-rotate-left" style="color: #2e511f;"></i> History',
        'url' => ['/videos/history']
      ]
    ]
])?>
          
      </div>
</div>

</aside>