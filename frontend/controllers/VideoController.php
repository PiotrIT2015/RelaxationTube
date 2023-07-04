<?php

namespace frontend\controllers;

use yii\web\Controller;

use yii\data\ActiveDataProvider;
use common\models\Videos;


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
}