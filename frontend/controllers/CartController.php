<?php

namespace frontend\controllers;

use common\models\Order;
use common\models\Product;
use common\models\OrderItems;
use yz\shoppingcart\ShoppingCart;
use common\models\PaymentForm;
use yii\web\Request;
use \Instapago\Api;

class CartController extends \yii\web\Controller
{
    private $keyId = '74D4A278-C3F8-4D7A-9894-FA0571D7E023';
    private $publicKeyId = 'e9a5893e047b645fed12c82db877e05a';

    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->put($product);
            return $this->goBack();
        }
    }

    public function actionList()
    {
        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        $products = $cart->getPositions();
        $total = $cart->getCost();

        return $this->render('list', [
           'products' => $products,
           'total' => $total,
        ]);
    }

    public function actionRemove($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->remove($product);
            $this->redirect(['cart/list']);
        }
    }

    public function actionUpdate($id, $quantity)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->update($product, $quantity);
            $this->redirect(['cart/list']);
        }
    }

    public function actionCashOrder()
    {
        $order = new Order();

        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        /* @var $products Product[] */
        $products = $cart->getPositions();
        
        if ($order->load(\Yii::$app->request->post())) {
            $transaction = $order->getDb()->beginTransaction();
            $order->save(false);
            // guarda la orden
            foreach($products as $product) {
                $orderItem = new OrderItems();
                $orderItem->order_id = $order->id;
                $orderItem->name = $product->name;
                $orderItem->price = $product->getPrice();
                $orderItem->product_id = $product->id;
                $orderItem->quantity = $product->getQuantity();
                if (!$orderItem->save(false)) {
                    $transaction->rollBack();
                    \Yii::$app->session->addFlash('error', 'Cannot place your order. Please contact us.');
                    return $this->redirect('catalog/list');
                }
            }

            $transaction->commit();
            \Yii::$app->cart->removeAll();

            \Yii::$app->session->addFlash('success', 'Thanks for your order. We\'ll contact you soon.');
            $order->sendEmail();

            return $this->redirect('catalog/list');
        }

        return $this->render('orderCash', [
            'payment' => $payment,
            'products' => $products,
            'total' => $total,
        ]);
    }

    public function actionOrder()
    {
        $order = new Order();
        $payment = new PaymentForm();

        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        /* @var $products Product[] */
        $products = $cart->getPositions();
        $total = $cart->getCost();
        $payment->IP = \Yii::$app->request->getUserIP();
        if ($payment->load(\Yii::$app->request->post())) {
            $paymentData = [
                'amount' => $total,
                'description' => $payment->Description,
                'card_holder' => $payment->CardHolder,
                'card_holder_id' => $payment->CardHolderId,
                'card_number' => $payment->CardNumber,
                'cvc' => $payment->CVC,
                'expiration' => $payment->ExpirationDate,
                'ip' => $payment->IP
            ];
            try{
                $api = new Api($this->keyId, $this->publicKeyId);
                $respuesta = $api->directPayment($paymentData);

                $transaction = $order->getDb()->beginTransaction();
                $order->data = '2018-02-01';
                $order->amount = $total;
                $order->ip = $payment->IP;
                $order->save(false);
                // guarda la orden
                foreach($products as $product) {
                    $orderItem = new OrderItems();
                    $orderItem->order_id = $order->id;
                    $orderItem->name = $product->name;
                    $orderItem->price = $product->getPrice();
                    $orderItem->product_id = $product->id;
//                    $orderItem->quantity = $product->getQuantity();
                    if (!$orderItem->save(false)) {
                        $transaction->rollBack();
                        \Yii::$app->session->addFlash('error', 'Cannot place your order. Please contact us.');
                        return $this->redirect('catalog/list');
                    }
                }

                $transaction->commit();
                \Yii::$app->cart->removeAll();

                \Yii::$app->session->addFlash('success', var_dump($respuesta));

                //$order->sendEmail();

                return $this->redirect('product/search');
            }catch(\Instapago\Exceptions\InstapagoException $e){    
              echo "Ocurrió un problema procesando el pago.";
              // manejar el error 
            }

        }

        return $this->render('order', [
            'payment' => $payment,
            'products' => $products,
            'total' => $total,
        ]);
    }
}
