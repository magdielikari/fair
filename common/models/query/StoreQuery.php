<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Store]].
 *
 * @see \common\models\Store
 */
class StoreQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Store[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Store|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
