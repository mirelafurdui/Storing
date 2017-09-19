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

// $productModel= new Product();
// instantiate classes related to Cart module: model & view
$cartModel = new Cart(Dot_Request::getUserAgent(), Dot_Request::getHttpReffer()); 
$cartView = new Cart_View($tpl);

$userView = new User_View($tpl);

// all actions MUST set  the variable  $pageTitle
$pageTitle = $option->pageTitle->action->{$registry->requestAction};


switch ($registry->requestAction)
{	default:

	//show all products in cart
	case 'show-cart':

	    // get total number of products from cart
		$cart['userId'] = $registry->session->user->id ?? 0;

		$totalCart = $cartModel->sumProductsFromCart($cart['userId']);

		$userId = $session->user->id;

		$idCart = $cartModel->getIdCart($userId);

		$data = $cartModel->getProductToCart($idCart['id']);

		$cartView->showCartProductList('cart', $data, $totalCart);

	break;

	//add product in cart
	case 'cart':

	    $id = $registry->request['id'];

	    $userId = $session->user->id;

	    $idCart = $cartModel->getIdCart($userId);

	    $data = $cartModel->getProductToCart($idCart['id']);

	    $cart = $cartModel->getProduct($id);

	    $cartId = $cartModel->getCart($userId);

	    // verify if exist product in cart
        $test = $cartModel->testIfProductExistInTheCart($id,$idCart['id']);

        //if exist the product in cart, increment quantity
        if($test=="1") {

            $product = $cartModel->getProductCartDetails($id,$cartId['id']);

			if($product['quantity']<$product['stoc']) {

			    $product['quantity']++;

				$cartModel->updateQuantity($product,$id,$cartId['id']);

				header('Location: '.$registry->configuration->website->params->url."/cart/show-cart"); exit;
			}
		}

		// if it doesn't exist, add product to cart
		$cartModel->addProductToCart($cart,$cartId['id']);	

        // refresh the page
		header('Location: '.$registry->configuration->website->params->url."/cart/show-cart"); exit;

	break;
	
	// checkout makes an invoice and empty's the cart
	case 'checkout':

	    $cart['userId'] = $registry->session->user->id ?? 0;

		$totalCart = $cartModel->sumProductsFromCart($cart['userId']) ?? 0;

		$userId = $session->user->id;

		$userDetails = $cartModel->getUserDetails($userId);

		$idCart = $cartModel->getIdCart($userId);

		$data = $cartModel->getProductToCart($idCart['id']);



		foreach ($data as $value) {
			foreach ($value as $key => $value1) {
				if ($key =="quantity") {
					$q = $value1;
				}
				if ($key =="productId") {
					$p = $value1;
				}
			}
			if (!empty($q) && !empty($p)) {
				$cartModel->decreasesNumberProduct($q,$p);

				$cartModel->deleteCart($p,$idCart['id']);
			}
		}

            $cartView->showCartProductList('invoice', $data, $userDetails, $totalCart);

			$cartView->showUserDetails('invoice',$userDetails, $totalCart);

	break;
	
	// delete a product from the cart
	case 'delete':
		$id = $registry->request['id'];
		$userId = $session->user->id;
		$cartId = $cartModel->getCartID($userId);
		$cartModel->deleteProduct($id,$cartId['id']);
		header('Location: '.$registry->configuration->website->params->url."/cart/showCart"); exit;
	break;

	// adding quantity to cart
	case 'addq':
		$userId = $session->user->id;

		$cartId = $cartModel->getCart($userId);
		$id = $registry->request['id'];
		$product = $cartModel->getProductCartDetails($id,$cartId['id']);

		if ($product['quantity']<$product['stoc']) 
		{
			$product['quantity']++;
			$cartModel->updateQuantity($product,$id,$cartId['id']);
		}else{
			$cartModel->updateQuantity($product,$id,$cartId['id']);
		}
		header('Location: '.$registry->configuration->website->params->url."/cart/showCart"); exit;
	break;

	// deletes quantity from cart
	case 'delq':
		$userId = $session->user->id;

		$cartId = $cartModel->getCart($userId);

		$id = $registry->request['id'];

		$product = $cartModel->getProductCartDetails($id,$cartId['id']);
		
		if ($product['quantity'] == 1) 
		{
			$cartModel->deleteProduct($id,$cartId['id']);
			header('Location: '.$registry->configuration->website->params->url."/cart/showCart"); exit;
		}else{
			$product['quantity']--;
			$cartModel->updateQuantity($product,$id,$cartId['id']);
			header('Location: '.$registry->configuration->website->params->url."/cart/showCart"); exit;
		}
		$data = $cartModel->getProductToCart($userId,$cartId['id']);
		$cartView->showCartProductList('cart', $data);
		// header('Location: '.$registry->configuration->website->params->url."/product"); exit;
		break;
}






	