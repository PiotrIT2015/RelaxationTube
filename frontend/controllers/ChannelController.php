<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\User;
use yii\web\NotFoundHttpException;

/**
 * Channel controller
 */
class ChannelController extends Controller
{
    public function actionView($username)
    {
        $channel=$this->findChannel($username);
        return $this->render('view',[
            'channel'=>$channel
        ]);
    }

    /**
     * @param $username
     * @throws \yii\web\NotFoundHttpException
     */
    public function findChannel($username)
    {
        $channel=User::findByUsername($username);
        if(!$channel){
            throw new NotFoundHttpException("Channel does not exist.");
        }

        return $channel;
    }
}