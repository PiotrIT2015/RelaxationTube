<?php

namespace common\models\query;

use common\models\Videos;

/**
 * This is the ActiveQuery class for [[\common\models\Videos]].
 *
 * @see \common\models\Videos
 */
class VideosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Videos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Videos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function creator($userId)
    {
        return $this->andWhere(['created_by'=>$userId]);
    }

    public function latest()
    {
        return $this->orderBy(['created_at'=>SORT_DESC]);
    }

    public function published()
    {
        return $this->andWhere(['status'=>Videos::STATUS_PUBLISHED]);
    }
}
