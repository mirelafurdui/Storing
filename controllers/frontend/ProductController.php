<?php
$productModel= new Product();
$productView= new Product_View($tpl);
$pageTitle = $option->pageTitle->action->{$registry->requestAction};

switch ($registry->requestAction) {
	default:
	case 'home':
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		$list = $productModel->getProductList($page);
		
		$product = $productView->showProductList('home', $list, $page);
		break;

	case 'show':
		$certainProduct = $productModel->getProductById($registry->request['id']);
		$productView->showCertainProduct('home_product',$certainProduct);
		break;

	case 'about':
		$productView->showPage($registry->requestAction);
		break;
}