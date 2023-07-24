<?php
// tests/functional/controllers/VideosControllerTest.php

namespace tests\functional\controllers;

use backend\controllers\VideosController;
use common\models\Videos;
use Yii;
use yii\web\UploadedFile;

class VideosControllerTest extends \yii\codeception\TestCase
{
    public $appConfig = '@tests/functional/config.php';

    public function testActionCreate()
    {
        // Set up the request with a POST method and UploadedFile
        $this->app->request->setMethod('POST');
        $this->app->request->setBodyParams(['Videos' => ['video' => new UploadedFile(['name' => 'test.mp4', 'type' => 'video/mp4', 'tmp_name' => '/tmp/test.mp4', 'error' => UPLOAD_ERR_OK, 'size' => 12345])]]);

        // Call the actionCreate method
        $response = $this->app->runAction('videos/create');

        // Assert that the response is a redirect
        $this->assertInstanceOf(\yii\web\Response::class, $response);
    }
}
