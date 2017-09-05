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
	if (!isset($_SESSION['pageValue'])) {
		$_SESSION['pageValue'] = 9;
	}
	if (in_array($action, ['9', '15','21','24'])) {
		$response['action'] = $action;
		switch ($action) {
			case '9':
				$response['data']['voteValue'] = 9;
				$_SESSION['pageValue'] = 9;
				$response['success'] = true;
				$response['message'] = 'up success';
				break;
			case '15':
				$response['data']['voteValue'] = 15;
				$_SESSION['pageValue'] = 15;
				$response['success'] = true;
				$response['message'] = 'down success';
				break;
			case '21':
				$response['data']['voteValue'] = 21;
				$_SESSION['pageValue'] = 21;
				$response['success'] = true;
				$response['message'] = 'refresh success';
			break;
			case '24':
				$response['data']['voteValue'] = 24;
				$_SESSION['pageValue'] = 24;
				$response['success'] = true;
				$response['message'] = 'reset success';
			break;

		}
		echo json_encode($response);
	} 
	if (isset($_POST['srch'])) {
			$list = $productModel->searchProduct($page, $_POST['srch'], $_SESSION['pageValue']);
		}else {
			$list = $productModel->getProductList($page,$_SESSION['pageValue']);
		}
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
		// product id
		$id=$registry->request['id'];
		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;
		// this will get the information for a product
		$certainProduct = $productModel->getProductById($id);
		// get's all comments based on the given id
		$allCommentsForProduct = $productModel->getCommentByProduct($id,$page);
		// makes the total number of likes to all the comments separately
		$totalLikes=$productModel->sumLikesForComment();
		// makes the average rating of a product
		$averageRating=$productModel->averageRating($id);
		// this is for adding comments/reviews using form
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// this is the logged user will be used for the form
			$loggedUserId = (array)$_SESSION['frontend']['user'];
			if ($loggedUserId['username'] != '') {
				$userData = (array) $_SESSION['frontend']['user'];
				$data['rating'] = (isset($_POST['rating'])) ? $_POST['rating']:'';
				$data['title'] = (isset($_POST['title'])) ? $_POST['title']:'';
				$data['comment'] = (isset($_POST['comment'])) ? $_POST['comment']:'';
				$data['userId'] = (isset($userData['id'])) ? $userData['id']:'';
				$data['isActive'] = 1;
				$data['productId'] = (isset($registry->request['id'])) ? $registry->request['id']:'';
				$productModel->addCommentToCertainProduct($data);
			// this else will redirect the user if he's not logged in
			} elseif (!isset($loggedUserId['username'])) {
				header('Location: '.$registry->configuration->website->params->url. '/user/register');
			}
		}

		// shows comments on a product
		$productView->showCertainProduct('home_product',$certainProduct, $averageRating);
		// this will show all the comments and total likes for a specific product
		$allCommentsForProductView = $productView->showCommentsByProduct('home_product', $allCommentsForProduct, $page, $totalLikes);
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
		/*$_POST['info'] is the vote value*/
		$userSession = (array) $_SESSION['frontend']['user'];
		// this is the id of the logged user.
		$userId = $userSession['id'];
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
		if ($action == 'upVote' && $userId != "" && $_POST['info'] == '1') {
			$value=0;
			$response['action'] = $action;
			$response['data']['voteValue'] = ++$value;
			$response['success'] = true;
			$response['message'] = "UP Successfull";
			$update = $productModel->voteACertainComment($value, $id, $userId);
			echo Zend_Json::encode($response);
			exit();
		}
		// an if that checks for the action an value
		if ($action == 'downVote' && $userId != "" && $_POST['info'] == '-1') {
			$response['action'] = $action;
			$response['data']['voteValue'] = --$value;
			$response['success'] = true;
			$response['message'] = "DOWN Successfull";
			$update = $productModel->voteACertainComment($value, $id, $userId);
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
		else {
			header('Location: '.$registry->configuration->website->params->url. '/user/'.'register');
		}
		break;
}