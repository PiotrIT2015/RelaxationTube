<?php

use Yii;

use common\models\Videos;
use common\models\VideoLike;
use yii\web\UploadedFile;

class VideosTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        // Yii2 bootstrap, you may need to adjust this according to your setup
        \Yii::setAlias('@common', dirname(__DIR__));
        $config = require(\Yii::getAlias('@common/config/main.php'));
        new \yii\console\Application($config);
    }

    protected function tearDown(): void
    {
        // Clean up the database after each test
        Videos::deleteAll();
        VideoLike::deleteAll();
    }

    public function testSave()
    {
        $video = new UploadedFile([
            'name' => 'sample_video.mp4',
            'type' => 'video/mp4',
            'tmp_name' => '/tmp/sample_video.mp4',
            'error' => UPLOAD_ERR_OK,
            'size' => 1024,
        ]);

        $thumbnail = new UploadedFile([
            'name' => 'sample_thumbnail.jpg',
            'type' => 'image/jpeg',
            'tmp_name' => '/tmp/sample_thumbnail.jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => 1024,
        ]);

        $model = new Videos();
        $model->video = $video;
        $model->thumbnail = $thumbnail;
        $model->title = 'Test Video';
        $model->status = Videos::STATUS_PUBLISHED;

        $this->assertTrue($model->save());

        // Check if the video and thumbnail files were saved correctly
        $videoPath = Yii::getAlias('@frontend/web/storage/videos/') . $model->video_id . '.mp4';
        $this->assertFileExists($videoPath);

        $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbs/') . $model->video_id . '.jpg';
        $this->assertFileExists($thumbnailPath);
    }

    public function testGetVideoLink()
    {
        $model = new Videos();
        $model->video_id = 'sample_video_id';

        $expectedLink = Yii::$app->params['frontendUrl'] . '/storage/videos/sample_video_id.mp4';
        $this->assertEquals($expectedLink, $model->getVideoLink());
    }

    public function testGetThumbnailLink()
    {
        $model = new Videos();
        $model->video_id = 'sample_video_id';
        $model->has_thumbnail = true;

        $expectedLink = Yii::$app->params['frontendUrl'] . '/storage/thumbs/sample_video_id.jpg';
        $this->assertEquals($expectedLink, $model->getThumbnailLink());
    }

    // Add more test cases for other methods as needed
}
