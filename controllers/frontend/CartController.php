<?php
/**
 * Apidemia Technologies Inc.
 * Apidemia Application Framework
 *
 * @category   Apidemia
 * @package    Frontend
 * @copyright  Copyright (c) Apidemia (http://www.dotboost.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    $Id: CartController.php 2017-30-08 12:34:50Z mirela $
 */

/**
 * Cart Controller
 * @author     Apidemia Team <team@dotkernel.com>
 */

$session = Zend_Registry::get('session');

// instantiate classes related to Cart module: model & view
$cartModel = new Cart(Dot_Request::getUserAgent(), Dot_Request::getHttpReffer()); 
$cartView = new Cart_View($tpl);
// all actions MUST set  the variable  $pageTitle
$pageTitle = $option->pageTitle->action->{$registry->requestAction};
switch ($registry->requestAction)
{	default:

	case 'showCart':
		$userId = $session->user->id;
		$data = $cartModel->getProductToCart($userId);
		
		$cartView->showCartProductList('cart', $data);
	break;

	case 'cart':
	//product id
		$id = $registry->request['id'];
	//user id
		$userId = $session->user->id;
		$cart = $cartModel->getProduct($id);
		$cartId = $cartModel->getCart($userId);

		$cartModel->addProductToCart($cart,$cartId['id']);	
		header('Location: '.$registry->configuration->website->params->url."/cart/showCart"); exit;
	break;

	case 'checkout':
		$userId = $session->user->id;
		$data = $cartModel->getProductToCart($userId);
		$cartView->showCartProductList('invoice', $data);
	break;

	case 'delete':
		$id = $registry->request['id'];
		$cartModel->deleteProduct($id);
		header('Location: '.$registry->configuration->website->params->url."/cart/showCart"); exit;
	break;

	case 'addq':
		$id = $registry->request['id'];
		$product = $cartModel->getProductCartDetails($id);
		if ($product['quantity']<$product['stoc']) {
			$product['quantity']= $product['quantity']+1;
		}
		$cartModel->updateQuantity($product,$id);

		$userId = $session->user->id;
		$data = $cartModel->getProductToCart($userId);
		
		$cartView->showCartProductList('cart', $data);
	break;
	case 'delq':
		$id = $registry->request['id'];
		$product = $cartModel->getProductCartDetails($id);
		if ($product['quantity'] == 1) 
		{
			$cartModel->deleteProduct($id);
			header('Location: '.$registry->configuration->website->params->url."/cart/showCart"); exit;
		}else{
			$product['quantity']= $product['quantity']-1;
			$cartModel->updateQuantity($product,$id);
		}
		$userId = $session->user->id;
		$data = $cartModel->getProductToCart($userId);
		$cartView->showCartProductList('cart', $data);
		break;
}






	