<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $imagen
 * @property string $password_hash
 * @property string $password_rest_token
 * @property string $email
 * @property integer $status
 * @property string $password
 * @property string $facebook
 * @property string $instagram
 * @property string $twitter
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Record[] $records
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password_hash', 'email'], 'required'],
            [['status', 'phone', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 127],
            [['auth_key'], 'string', 'max' => 31],
            [['imagen', 'password_hash', 'password_rest_token', 'email'], 'string', 'max' => 251],
            [['password', 'facebook', 'instagram', 'twitter'], 'string', 'max' => 47],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'imagen' => Yii::t('app', 'Imagen'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_rest_token' => Yii::t('app', 'Password Rest Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'password' => Yii::t('app', 'Password'),
            'facebook' => Yii::t('app', 'Facebook'),
            'instagram' => Yii::t('app', 'Instagram'),
            'twitter' => Yii::t('app', 'Twitter'),
            'phone' => Yii::t('app', 'Phone'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecords()
    {
        return $this->hasMany(Record::className(), ['user_id' => 'id']);
    }
}
