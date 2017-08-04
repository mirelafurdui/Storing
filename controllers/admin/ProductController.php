<?php
$productModel= new Product();
$productView= new Product_View($tpl);
$pageTitle = $option->pageTitle->action->{$registry->requestAction};

switch ($registry->requestAction) {
	default:
	// this will list all products
	case 'list':
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;
		$list = $productModel->getProductList($page);
		$product = $productView->showProductList('product_list', $list, $page);
		break;

	case 'add':
		$productView->addProduct('product_add');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		 $productModel->addProduct($_POST);
		}
		break;

	case 'delete':
		# code...
		break;

	case 'edit':
		# code...
		break;
	// this will show a product
	case 'show':
		$certainProduct = $productModel->getProductById($registry->request['id']);
		$product = $productView->showCertainProduct('product_show', $certainProduct);
		break;
}