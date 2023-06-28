<?php

namespace common\models;

use Yii;

use yii\helpers\FileHelper;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "{{%videos}}".
 *
 * @property string $video_id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $status
 * @property int|null $has_thumbnail
 * @property string|null $video_name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Videos extends \yii\db\ActiveRecord
{
    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @var \yii\web\UploadedFile
     */
    public $video;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%videos}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video'], 'file', 'skipOnEmpty' => false, 'extensions' => 'mp4'],
            [['video_id', 'title'], 'required'],
            [['description'], 'string'],
            [['status', 'has_thumbnail', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['title', 'tags', 'video_name'], 'string', 'max' => 512],
            [['video_id'], 'unique'],
            ['has_thumbnail','default', 'value'=>0],
            ['status','default','value'=>self::STATUS_UNLISTED],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'video_id' => 'Video ID',
            'title' => 'Title',
            'description' => 'Description',
            'tags' => 'Tags',
            'status' => 'Status',
            'has_thumbnail' => 'Has Thumbnail',
            'video_name' => 'Video Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VideosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideosQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
{
    echo '<pre>';
    var_dump($this->video);
    echo '</pre>';

    //die();

    $isInsert = $this->isNewRecord;
if ($isInsert) {
    $this->video_id = Yii::$app->security->generateRandomString(8);
    $this->title = $this->video->name;
    $this->video_name = $this->video->name;
}

$saved = parent::save($runValidation, $attributeNames);

if (!$saved) {
    return false;
}

if ($isInsert) {
    $filePath = Yii::getAlias('@frontend/web/storage/videos/');
    $permissions = 0777;

    FileHelper::createDirectory($filePath, $permissions, true);


    $videoPath = $filePath . $this->video_id . '.mp4';
    if ($this->video instanceof \yii\web\UploadedFile) {
        $this->video->saveAs($videoPath);
    } else {
        // Handle the case when $this->video is not set or is not an UploadedFile
        // You may throw an exception or handle it based on your requirements.
    }
}

return true;

}

public function getVideoLink()
{
    return Yii::$app->params['frontendUrl'].'/views/web/storage/videos/'.$this->video_id.'.mp4';
}

}
