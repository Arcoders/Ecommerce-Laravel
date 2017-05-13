<?php 
namespace App;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


class PayPal
{
	private $_api_context;
	private $shopping_cart;

	public function __construct($shopping_cart){


		$paypal_conf = \Config::get('paypal_payment');

		$this->_api_context = new ApiContext(new OAuthTokenCredential(
			$paypal_conf['client_id'], $paypal_conf['secret']
		));

		$this->_api_context->setConfig($paypal_conf['settings']);

		$this->shopping_cart = $shopping_cart;
	}

	public function generate(){
		$payment = new Payment();
		$payment->setIntent('sale')
				->setPayer($this->payer())
				->setTransactions([$this->transaction()])
				->setRedirectUrls($this->redirectURLs());
		try{
			$payment->create($this->_api_context);
		}catch(\Exception $ex){
			dd($ex);
			exit(1);
		}
		return $payment;
	}

	public function payer(){
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		return $payer;
	}

	public function transaction(){
		$transaction = new Transaction();
		$transaction->setAmount($this->amount())
					->setItemList($this->items())
					->setDescription('Tu compra en Arcoders')
					->setInvoiceNumber(uniqid());
		return $transaction;
	}

	public function items(){
		$items = [];
		$products = $this->shopping_cart->products()->get();
		foreach ($products as $product) {
			array_push($items, $product->paypalItem());
		}
		$itemList = new ItemList();
		$itemList->setItems($items);
		return $itemList;
	}

	public function amount(){
		$amount = new Amount();
		$amount->setCurrency('USD')
			   ->setTotal($this->shopping_cart->totalUSD());
		return $amount;
	}

	public function redirectURLs(){
		$baseURL = url('/');
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("{$baseURL}/payments/store")
					 ->setCancelUrl("{$baseURL}/carrito");
		return $redirectUrls;
	}

	public function execute($paymentId, $payerId){
		$payment = Payment::get($paymentId, $this->_api_context);
		$execution = new PaymentExecution();
		$execution->setPayerId($payerId);
		return $payment->execute($execution, $this->_api_context);
	}


}