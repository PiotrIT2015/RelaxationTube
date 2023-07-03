<?php

use common\models\Videos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Videos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'title',
                'content'=>function($model){
                    return $this->render('_video_item',['model'=>$model]);
                }
            ],

            [
                'attribute'=>'status',
                'content'=>function($model){
                    return $model->getStatusLabels()[$model->status];
                }
            ],
            //'has_thumbnail',
            //'video_name',
            'created_at:datetime',
            'updated_at:datetime',
            //'created_by',
            //[
            //    'class' => ActionColumn::className(),
            //    'urlCreator' => function ($action, Videos $model, $key, $index, $column) {
            //        return Url::toRoute([$action, 'video_id' => $model->video_id]);
            //     }     
            //],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete'=>function($url){
                        return Html::a('Delete',$url,[
                            'data-method'=>'post'
                        ]);
                    }
                 ]
            ],
        ],
    ]); ?>


</div>
