<?php
// tests/unit/controllers/VideosControllerTest.php

namespace tests\unit\controllers;

use backend\controllers\VideosController;
use common\models\Videos;
use Yii;
use yii\web\UploadedFile;

class VideosControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testActionCreate()
    {
        // Create a mock of the Videos model
        $model = $this->getMockBuilder(Videos::class)
            ->setMethods(['save'])
            ->getMock();
        
        // Configure the mock to return true for the save method
        $model->expects($this->once())
            ->method('save')
            ->willReturn(true);

        // Create a mock of the controller
        $controller = $this->getMockBuilder(VideosController::class)
            ->disableOriginalConstructor()
            ->setMethods(['findModel'])
            ->getMock();

        // Configure the controller mock to return the Videos model mock
        $controller->expects($this->once())
            ->method('findModel')
            ->willReturn($model);

        // Set up the request with a POST method and UploadedFile
        $request = Yii::$app->getRequest();
        $request->setMethod('POST');
        $request->setBodyParams(['Videos' => ['video' => new UploadedFile(['name' => 'test.mp4', 'type' => 'video/mp4', 'tmp_name' => '/tmp/test.mp4', 'error' => UPLOAD_ERR_OK, 'size' => 12345])]]);

        // Call the actionCreate method
        $response = $controller->actionCreate();

        // Assert that the response is a redirect
        $this->assertInstanceOf(\yii\web\Response::class, $response);
    }
}
