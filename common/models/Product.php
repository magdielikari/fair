<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;


/**
 * This is the model class for table "product".
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property double $price
 * @property string $pappid
 * @property string $status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $category_id
 * @property string $store_id
 *
 * @property OrderItems[] $orderItems
 * @property Category $category
 * @property Store $store
 */
class Product extends \yii\db\ActiveRecord
{
        use CartPositionTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     *
     */
    public function behaviors()
    {
        return [
            'imageUploaderBehavior' => [
                'class' => 'demi\image\ImageUploaderBehavior',
                'imageConfig' => [
                    // Name of image attribute where the image will be stored
                    'imageAttribute' => 'image',
                    // Yii-alias to dir where will be stored subdirectories with images
                    'savePathAlias' => '@public/images/product',
                    // Yii-alias to root project dir, relative path to the image will exclude this part of the full path
                    'rootPathAlias' => '@public',
                    // Name of default image. Image placed to: webrooot/images/{noImageBaseName}
                    // You must create all noimage files: noimage.jpg, medium_noimage.jpg, small_noimage.jpg, etc.
                    'noImageBaseName' => 'noimage.jpg',
                    // List of thumbnails sizes.
                    // Format: [prefix=>max_width]
                    // Thumbnails height calculated proportionally automatically
                    // Prefix '' is special, it determines the max width of the main image
                    'imageSizes' => [
                        '' => 1000,
                        'medium_' => 270,
                        'small_' => 70,
                        'my_custom_size' => 25,
                    ],
                    // This params will be passed to \yii\validators\ImageValidator
                    'imageValidatorParams' => [
                        'minWidth' => 400,
                        'minHeight' => 300,
                    ],
                    // Cropper config
                    'aspectRatio' => 4 / 3, // or 16/9(wide) or 1/1(square) or any other ratio. Null - free ratio
                    // default config
                    'imageRequire' => false,
                    'fileTypes' => 'jpg,jpeg,gif,png',
                    'maxFileSize' => 10485760, // 10mb
                    // If backend is located on a subdomain 'admin.', and images are uploaded to a directory
                    // located in the frontend, you can set this param and then getImageSrc() will be return
                    // path to image without subdomain part even in backend part
                    'backendSubdomain' => 'admin.',
                ],
            ],
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'category_id'], 'required'],
            [['price'], 'number'],
            [['pappid', 'created_at', 'created_by', 'updated_at', 'updated_by', 'category_id', 'store_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 257],
            [['image'], 'string', 'max' => 251],
            [['status'], 'string', 'max' => 2],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
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
            'slug' => Yii::t('app', 'Slug'),
            'image' => Yii::t('app', 'Image'),
            'price' => Yii::t('app', 'Price'),
            'pappid' => Yii::t('app', 'Pappid'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'category_id' => Yii::t('app', 'Category ID'),
            'store_id' => Yii::t('app', 'Store ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductQuery(get_called_class());
    }
}
