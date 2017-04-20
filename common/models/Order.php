<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $description
 * @property string $data
 * @property double $amount
 * @property string $ip
 * @property string $deposit
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $status
 *
 * @property Approved[] $approveds
 * @property OrderItems[] $orderItems
 * @property Response[] $responses
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data', 'amount', 'ip'], 'required'],
            [['data'], 'safe'],
            [['amount'], 'number'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['description'], 'string', 'max' => 127],
            [['ip'], 'string', 'max' => 19],
            [['deposit'], 'string', 'max' => 47],
            [['status'], 'string', 'max' => 73],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
            'data' => Yii::t('app', 'Data'),
            'amount' => Yii::t('app', 'Amount'),
            'ip' => Yii::t('app', 'Ip'),
            'deposit' => Yii::t('app', 'Deposit'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveds()
    {
        return $this->hasMany(Approved::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['order_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderQuery(get_called_class());
    }
}
