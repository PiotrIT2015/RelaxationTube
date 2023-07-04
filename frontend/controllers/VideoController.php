<?php

namespace frontend\controllers;

use yii\web\Controller;

use yii\data\ActiveDataProvider;
use common\models\Videos;

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

        return $this->render('view', [
            'model' => $video
        ]);
    }
}