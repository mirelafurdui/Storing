<?php
$productModel= new Product();
$productView= new Product_View($tpl);
$pageTitle = $option->pageTitle->action->{$registry->requestAction};

switch ($registry->requestAction) {
	default:

	//this case will take you to the product list
	case 'home':
		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;
		// this variable will use the function to get all the products using $page for pagination
		$list = $productModel->getProductList($page);

		$product = $productView->showProductList('home', $list, $page);
		break;
		
	//this case will take you to the category page
	case 'show_category':
		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		// this variable will use the function to get all the brands using $page for pagination
		$listCategory = $productModel->getCategoryList($page);
		
		$product = $productView->showCategoryList('category', $listCategory, $page);
		break;

	//this case will take you to the brand page
	case 'show_brand':
		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		// this variable will use the function to get all the brands using $page for pagination
		$listBrand = $productModel->getBrandList($page);
		
		$product = $productView->showBrandList('brand', $listBrand, $page);
		break;

	//this case will take you to the product page
	case 'show':
		$certainProduct = $productModel->getProductById($registry->request['id']);
		$productView->showCertainProduct('home_product',$certainProduct);
		break;

	//this case will take you to a certain brand
	case 'brand':
		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		$id = $registry->request['id'];
		// this variable will use the function to get the Product By Brand using the given id and page(for paginaton)
		$productByBrand = $productModel->getProductByBrand($id,$page);

		$productView->showCertainBrand('home_brand',$productByBrand, $page);
		break;

	//this case will take you to a certain category
	case 'category':
		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		$id = $registry->request['id'];

		// this variable will use the function to get the Product By Category using the given id and page(for paginaton)
		$productByCategory = $productModel->getProductByCategory($id,$page);

		$productView->showCertainCategory('home_category',$productByCategory, $page);
		break;

	//this case will take you to the about page
	case 'about':
		$productView->showPage($registry->requestAction);
		break;
}