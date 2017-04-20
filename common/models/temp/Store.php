<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "store".
 *
 * @property string $id
 * @property string $name
 * @property string $slogan
 * @property string $rif
 * @property string $email
 * @property string $facebook
 * @property string $twitter
 * @property string $address
 * @property string $instagram
 * @property string $image
 * @property string $sappid
 * @property string $status
 * @property string $phone1
 * @property string $phone2
 * @property string $phone3
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Banner[] $banners
 * @property Product[] $products
 * @property Record[] $records
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
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
                    'savePathAlias' => '@frontend/web/images/store',
                    // Yii-alias to root project dir, relative path to the image will exclude this part of the full path
                    'rootPathAlias' => '@frontend/web',
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
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sappid', 'phone1', 'phone2', 'phone3', 'created_at', 'updated_at'], 'integer'],
            [['name', 'email'], 'string', 'max' => 127],
            [['slogan', 'image'], 'string', 'max' => 251],
            [['rif'], 'string', 'max' => 11],
            [['facebook', 'twitter', 'instagram'], 'string', 'max' => 47],
            [['address'], 'string', 'max' => 773],
            [['status'], 'string', 'max' => 2],
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
            'slogan' => Yii::t('app', 'Slogan'),
            'rif' => Yii::t('app', 'Rif'),
            'email' => Yii::t('app', 'Email'),
            'facebook' => Yii::t('app', 'Facebook'),
            'twitter' => Yii::t('app', 'Twitter'),
            'address' => Yii::t('app', 'Address'),
            'instagram' => Yii::t('app', 'Instagram'),
            'image' => Yii::t('app', 'Image'),
            'sappid' => Yii::t('app', 'Sappid'),
            'status' => Yii::t('app', 'Status'),
            'phone1' => Yii::t('app', 'Phone1'),
            'phone2' => Yii::t('app', 'Phone2'),
            'phone3' => Yii::t('app', 'Phone3'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banner::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecords()
    {
        return $this->hasMany(Record::className(), ['store_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\StoreQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\StoreQuery(get_called_class());
    }
}
