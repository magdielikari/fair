<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property string $id
 * @property string $name
 * @property integer $quantity
 * @property double $price
 * @property integer $number
 * @property integer $duration int
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $order_id
 * @property string $product_id
 * @property string $services_id
 *
 * @property Order $order
 * @property Product $product
 * @property Services $services
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity', 'number', 'duration int', 'created_at', 'created_by', 'updated_at', 'updated_by', 'order_id', 'product_id', 'services_id'], 'integer'],
            [['price', 'services_id'], 'required'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 127],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'price' => Yii::t('app', 'Price'),
            'number' => Yii::t('app', 'Number'),
            'duration int' => Yii::t('app', 'Duration Int'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'order_id' => Yii::t('app', 'Order ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'services_id' => Yii::t('app', 'Services ID'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
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
     * @return \common\models\query\OrderItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderItemsQuery(get_called_class());
    }
}
