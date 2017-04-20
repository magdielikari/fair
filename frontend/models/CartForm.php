<?php
namespace frontend\models;

use Yii;

/**
 * Login form
 */
class CartForm extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['cardHolder', 'cardHolderID', 'cardNumber', 'expirationDate', 'description', 'cvc'], 'required'],
            // rememberMe must be a boolean value
            [['cardHolder','description'], 'string','max'=>127],
            // password is validated by validatePassword()
            ['cardHolderID', 'number','min' => 6,'max' => 8],
            ['cardNumber', 'number','min' => 15,'max' => 16],
            ['cvc', 'number','min'=>3,'max'=>3],
        ];
    }

}
