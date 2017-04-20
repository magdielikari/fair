<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PaymentForm extends Model
{
    public $Amount;
    public $Description;
    public $CardHolder;
    public $CardHolderId;
    public $CardNumber;
    public $CVC;
    public $ExpirationDate;
    public $IP;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['Description', 'CardHolder', 'CardHolderId', 
            'CardNumber', 'CVC', 'ExpirationDate'], 'required'],
            [['Description', 'CardHolder'], 'string'],
            [['CardHolderId', 'CardNumber', 'CVC'],  'integer'],
            [['Amount'], 'number']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'Amount' => 'Monto',
            'Description' => 'Descripción de la Operación',
            'CardHolder' => 'Nombre del Tarjeta Habiente',
            'CardHolderId' => 'Cédula del Tarjeta Habiente',
            'CardNumber' => 'Numero de la Tarjeta de Crédito',
            'CVC' => 'Código Secreto de la Tarjeta',
            'Expiration' => 'Fecha de Expiración de la Tarjeta'
        ];
    }

}
