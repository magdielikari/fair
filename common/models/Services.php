<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "services".
 *
 * @property string $id
 * @property string $name
 * @property double $price
 * @property string $image
 * @property string $created_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property OrderItems[] $orderItems
 * @property ServicesItems[] $servicesItems
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
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
                    'savePathAlias' => '@public/images/services',
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
            [['name', 'price'], 'required'],
            [['price'], 'number'],
            [['created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 127],
            [['image'], 'string', 'max' => 251],
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
            'price' => Yii::t('app', 'Price'),
            'image' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['services_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesItems()
    {
        return $this->hasMany(ServicesItems::className(), ['services_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ServicesQuery(get_called_class());
    }
}
