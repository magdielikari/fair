<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "services_items".
 *
 * @property integer $id
 * @property string $name
 * @property integer $quantity
 * @property integer $number
 * @property integer $duration
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $services_id
 *
 * @property Services $services
 */
class ServicesItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'services_id'], 'required'],
            [['id', 'quantity', 'number', 'duration', 'created_at', 'created_by', 'updated_at', 'updated_by', 'services_id'], 'integer'],
            [['name'], 'string', 'max' => 47],
            [['services_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['services_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'quantity' => Yii::t('app', 'Quantity'),
            'number' => Yii::t('app', 'Number'),
            'duration' => Yii::t('app', 'Duration'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'services_id' => Yii::t('app', 'Services ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasOne(Services::className(), ['id' => 'services_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ServicesItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ServicesItemsQuery(get_called_class());
    }
}
