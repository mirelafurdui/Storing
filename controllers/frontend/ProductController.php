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

	//this case will take you to the product page & it will show comments based on product
	case 'show':
		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;
		$certainProduct = $productModel->getProductById($registry->request['id']);
		$productView->showCertainProduct('home_product',$certainProduct);
		// get's all comments based on the given id
		$allCommentsForProduct = $productModel->getCommentByProduct($registry->request['id'],$page);
		// shows comments on a product
		$allCommentsForProductView = $productView->showCommentsByProduct('home_product', $allCommentsForProduct, $page);
		// this transforms the object that is session into an array to use it for the if.
		$userData = (array) $_SESSION['frontend']['user'];
		// this is for adding comments using form
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data['rating'] = (isset($_POST['rating'])) ? $_POST['rating']:'';
			$data['title'] = (isset($_POST['title'])) ? $_POST['title']:'';
			$data['comment'] = (isset($_POST['comment'])) ? $_POST['comment']:'';
			$data['userId'] = (isset($userData['id'])) ? $userData['id']:'';
			$data['isActive'] = 1;
			$data['productId'] = (isset($registry->request['id'])) ? $registry->request['id']:'';
			$productModel->addCommentToCertainProduct($data);
			}
		// this is for deleting certain comments
		// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// 	$data['delete'] = (isset($_POST['delete'])) ? $_POST['delete']:'';
		// 	$productModel->deleteCommentToCertainProduct($id);
		// }
		// $productModel->editCommentToCertainProduct($data,$id);
		// 		header('Location: '.$registry->configuration->website->params->url.'/admin/'.x$registry->requestController. '/' . $registry->requestAction.'/id/'.$id); exit;
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