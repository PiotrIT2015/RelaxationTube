<?php

namespace frontend\controllers;

use yii\web\Controller;

use yii\data\ActiveDataProvider;
use common\models\Videos;
use common\models\VideoView;
use Yii;
use yii\web\NotFoundHttpException;


class VideoController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Videos::find()->published()->latest()
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $this->layout='blank';
        $video=Videos::findOne($id);
        if(!$video){
            throw new NotFoundHttpException("Video does not exist.");
        }

        $videoView=new VideoView();
        $videoView->video_id=$id;
        $videoView->user_id=Yii::$app->user->id;
        $videoView->created_at=time();
        $videoView->save();

        return $this->render('view', [
            'model' => $video
        ]);
    }
}