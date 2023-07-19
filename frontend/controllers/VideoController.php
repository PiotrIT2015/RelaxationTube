<?php

namespace frontend\controllers;

use yii\web\Controller;

use yii\data\ActiveDataProvider;
use common\models\Videos;
use common\models\VideoView;
use common\models\VideoLike;
use Yii;
use yii\web\NotFoundHttpException;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;



class VideoController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['like', 'dislike'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verb' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]
        ];
    }

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
        $video=$this->findVideo($id);

        $videoView=new VideoView();
        $videoView->video_id=$id;
        $videoView->user_id=Yii::$app->user->id;
        $videoView->created_at=time();
        $videoView->save();

        $similarVideos=Videos::find()
            ->published()
            ->byKeyword($video->title)
            ->andWhere(['NOT',['video_id'=>$id]])
            ->limit(10)
            ->all();

        return $this->render('view', [
            'model' => $video,
            'similarVideos' => $similarVideos
        ]);
    }

    public function actionLike($id)
    {
        $video=$this->findVideo($id);
        $userId=Yii::$app->user->id;

        $videoLikeDislike=VideoLike::find()
        ->userIdVideoId($userId, $id)
        ->one();

        if(!$videoLikeDislike){
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
        }else if($videoLikeDislike->type == VideoLike::TYPE_LIKE){
            $videoLikeDislike->delete();
        }else{
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
        }

        return $this->renderAjax('_buttons', [
            'model' => $video
        ]);
    }

    
    public function actionDislike($id)
    {
        $video=$this->findVideo($id);
        $userId=Yii::$app->user->id;

        $videoLikeDislike=VideoLike::find()
        ->userIdVideoId($userId, $id)
        ->one();

        if(!$videoLikeDislike){
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_DISLIKE);
        }else if($videoLikeDislike->type == VideoLike::TYPE_DISLIKE){
            $videoLikeDislike->delete();
        }else{
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_DISLIKE);
        }

        return $this->renderAjax('_buttons', [
            'model' => $video
        ]);
    }

    public function actionSearch($keyword)
    {
        $query = Videos::find()
            ->published()
            ->latest();
        if($keyword){
            $query->byKeyword($keyword);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('search', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function findVideo($id)
    {
        $video=Videos::findOne($id);
        if(!$video){
            throw new NotFoundHttpException("Video does not exist.");
        }
        return $video;
    }

    public function saveLikeDislike($videoId, $userId, $type)
    {
        $videoLikeDislike=new VideoLike();
        $videoLikeDislike->video_id=$videoId;
        $videoLikeDislike->user_id=$userId;
        $videoLikeDislike->type=$type;
        $videoLikeDislike->created_at=time();
        $videoLikeDislike->save();
    }
}