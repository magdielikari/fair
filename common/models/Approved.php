<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "approved".
 *
 * @property string $id
 * @property string $name
 * @property integer $quantity
 * @property integer $number
 * @property string $from
 * @property string $to
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $order_id
 *
 * @property Order $order
 */
class Approved extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approved';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity', 'number', 'created_at', 'created_by', 'updated_at', 'updated_by', 'order_id'], 'integer'],
            [['from', 'to'], 'safe'],
            [['order_id'], 'required'],
            [['name'], 'string', 'max' => 127],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
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
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'order_id' => Yii::t('app', 'Order ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ApprovedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ApprovedQuery(get_called_class());
    }
}
