<?php
$productModel= new Product();
$productView= new Product_View($tpl);
$pageTitle = $option->pageTitle->action->{$registry->requestAction};

// variables needed by upvote and downvote in order to work

switch ($registry->requestAction) {
	default:

	//this case will take you to the product list
	case 'home':
		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;
		// this variable will use the function to get all the products using $page for pagination
		
		$action = $_POST['action'] ?? 'error';
		$response = [
			'success'=>false,
			'message'=>'Invalid action provided',
			'action'=>'error',
			'data'=>[
						'voteValue'=>''
					]
			];
	if (!isset($_SESSION['value'])) {
		$_SESSION['value'] = 5;
	}
	if (in_array($action, ['ten', 'fifteen','twenty','twentyfive'])) {
		$response['action'] = $action;
		switch ($action) {
			case 'ten':
				$response['data']['voteValue'] = 9;
				$_SESSION['value'] = 9;
				$response['success'] = true;
				$response['message'] = 'up success';
				break;
			case 'fifteen':
				$response['data']['voteValue'] = 15;
				$_SESSION['value'] = 15;
				$response['success'] = true;
				$response['message'] = 'down success';
				break;
			case 'twenty':
				$response['data']['voteValue'] = 21;
				$_SESSION['value'] = 21;
				$response['success'] = true;
				$response['message'] = 'refresh success';
			break;
			case 'twentyfive':
				$value = 0;
				$response['data']['voteValue'] = 24;
				$_SESSION['value'] = 24;
				$response['success'] = true;
				$response['message'] = 'reset success';
			break;

		}
		echo json_encode($response);
	} 
		$list = $productModel->getProductList($page,$_SESSION['value']);
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
		// $a = $allCommentsForProduct['data'];
		// $commentIds = [];
		// foreach ($allCommentsForProduct['data'] as $key => $value) {
		// 	$commentIds[$value['id']] = $value['id'];
		// }
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

	//this case is meant to represent a upvote to a comment
	case 'voting':
	
		// this is the action that's given from the script
		$action = $_POST['action'] ?? 'error';
		// this is the comment id that's given from the script
		$id = $_POST['id'];
		
		$response = [
					'success' => false,
					'message' => 'invalid action provided',
					'action' => 'error',
					'data' => [
						'voteValue' => ''
				 	],
		];
		// an if that checks for the action an value
		if ($action == 'upVote' && $_SESSION['value'] == 0) {
			$value=$_SESSION['value'];
			$response['action'] = $action;
			$response['data']['voteValue'] = ++$value;
			$_SESSION['value'] = $value;
			$response['success'] = true;
			$response['message'] = "UP Successfull";
			$update = $productModel->voteACertainComment($value,$id);
			echo Zend_Json::encode($response);
			exit();
			// an else that checks for the action an value
		}
		if ($action == 'downVote' && $_SESSION['value'] == 1) {
			$value=$_SESSION['value'];
			$response['action'] = $action;
			$response['data']['voteValue'] = --$value;
			$_SESSION['value'] = $value;
			$response['success'] = true;
			$response['message'] = "DOWN Successfull";
			$update = $productModel->voteACertainComment($value,$id);
			echo Zend_Json::encode($response);
			exit();
		}
		echo Zend_Json::encode($response);
		exit();
		break;

	// this case is meant to delete the user's comment
	case 'delete_user_comment':
		$loggedUserId = (array)$_SESSION['frontend']['user'];
	// user id
		$userId = $loggedUserId['id'];
	// comment id
		$commentId = $_POST['id'];
	// delete action
		$action = $_POST['action'] ?? 'error';
		if ($action == 'delete' && $userId=$loggedUserId['id']) {
			$response['action'] = $action;
			$response['success'] = true;
			$response['message'] = "Delete Successfull";
			$delete = $productModel->deleteCommentToCertainProduct($commentId, $userId);
			echo Zend_Json::encode($response);
			exit();
		}
		break;
}