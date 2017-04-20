<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class TransferForm extends Model
{
    public $ip;
    public $description;
    public $data;
    public $amount;
    public $deposit;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['description', 'data', 'amount','deposit'], 'required'],
            [['description', 'deposit'], 'string'],
            [['amount'], 'number']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'amount' => 'Monto',
            'description' => 'Descripción de la Operación',
            'deposit' => 'Numero de deposito',
            'data' => 'Fecha de operacion',
        ];
    }

}
