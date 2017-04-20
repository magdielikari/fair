<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "response".
 *
 * @property integer $id1
 * @property string $success
 * @property string $message
 * @property string $id
 * @property string $code
 * @property string $reference
 * @property resource $voucher
 * @property string $ordernumber
 * @property string $sequence
 * @property string $approval
 * @property string $lote
 * @property string $responsecode
 * @property string $deferred
 * @property string $datetime
 * @property double $amount
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $order_id
 *
 * @property Order $order
 */
class Response extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'response';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id1', 'order_id'], 'required'],
            [['id1', 'ordernumber', 'created_at', 'created_by', 'updated_at', 'updated_by', 'order_id'], 'integer'],
            [['voucher'], 'string'],
            [['datetime'], 'safe'],
            [['amount'], 'number'],
            [['success', 'deferred'], 'string', 'max' => 1],
            [['message'], 'string', 'max' => 211],
            [['id'], 'string', 'max' => 37],
            [['code', 'lote'], 'string', 'max' => 3],
            [['reference', 'approval'], 'string', 'max' => 7],
            [['sequence'], 'string', 'max' => 13],
            [['responsecode'], 'string', 'max' => 2],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id1' => Yii::t('app', 'Id1'),
            'success' => Yii::t('app', 'Success'),
            'message' => Yii::t('app', 'Message'),
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'reference' => Yii::t('app', 'Reference'),
            'voucher' => Yii::t('app', 'Voucher'),
            'ordernumber' => Yii::t('app', 'Ordernumber'),
            'sequence' => Yii::t('app', 'Sequence'),
            'approval' => Yii::t('app', 'Approval'),
            'lote' => Yii::t('app', 'Lote'),
            'responsecode' => Yii::t('app', 'Responsecode'),
            'deferred' => Yii::t('app', 'Deferred'),
            'datetime' => Yii::t('app', 'Datetime'),
            'amount' => Yii::t('app', 'Amount'),
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
     * @return \common\models\query\ResponseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ResponseQuery(get_called_class());
    }
}
