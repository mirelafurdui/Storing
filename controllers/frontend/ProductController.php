<?php
$productModel= new Product();
$productView= new Product_View($tpl);
$userModel = new User(Dot_Request::getUserAgent(), Dot_Request::getHttpReffer());
$pageTitle = $option->pageTitle->action->{$registry->requestAction};



switch ($registry->requestAction) {
	default:
	//this case will take you to the product list
	case 'home':
		// get total number of products from cart
			$cart['userId'] = $registry->session->user->id ?? 0;
			$totalCart = $productModel->sumProductsFromCart($cart['userId']);
		
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
		$product = $productView->showProductList('home', $list, $page, $totalCart);

		break;
		
	//this case will take you to the category page
	case 'show_category':
		// get total number of products from cart
		$cart['userId'] = $registry->session->user->id ?? 0;
		$totalCart = $productModel->sumProductsFromCart($cart['userId']);

		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		// this variable will use the function to get all the brands using $page for pagination
		$listCategory = $productModel->getCategoryList($page);
		
		$product = $productView->showCategoryList('category', $listCategory, $page, $totalCart);

		break;

	//this case will take you to the brand page
	case 'show_brand':
		// get total number of products from cart
		$cart['userId'] = $registry->session->user->id ?? 0;
		$totalCart = $productModel->sumProductsFromCart($cart['userId']);

		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		// this variable will use the function to get all the brands using $page for pagination
		$listBrand = $productModel->getBrandList($page);
		
		$product = $productView->showBrandList('brand', $listBrand, $page, $totalCart);

		break;

	//this case will take you to the product page & it will show comments based on product
	case 'show':
		// get total number of products from cart
		$cart['userId'] = $registry->session->user->id ?? 0;
		$totalCart = $productModel->sumProductsFromCart($cart['userId']);

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
			if (isset($_SESSION['frontend']['user']) && !empty($_SESSION['frontend']['user'])) {

				$loggedUserId = (array)$_SESSION['frontend']['user'];
                $userData = (array) $_SESSION['frontend']['user'];
                $data['rating'] = (isset($_POST['rating'])) ? $_POST['rating']:'';
                $data['title'] = (isset($_POST['title'])) ? $_POST['title']:'';
                $data['comment'] = (isset($_POST['comment'])) ? $_POST['comment']:'';
                $data['userId'] = (isset($userData['id'])) ? $userData['id']:'';
                $data['isActive'] = 1;
                $data['productId'] = (isset($registry->request['id'])) ? $registry->request['id']:'';
                $maxValuePerPost=$productModel->addCommentToCertainProduct($data,$loggedUserId['id'],$data['productId']);

				if ($loggedUserId['username'] != '' && $maxValuePerPost == 0) {
					$productModel->addCommentToCertainProduct($data,$loggedUserId['id'],$data['productId']);
					$registry->session->message['txt'] = $registry->option->infoMessage->addReview;
					$registry->session->message['type'] = 'info';
				// this else will tell the user that he can't have 2 reviews on the same product
				} elseif ($loggedUserId['username'] != '' && $maxValuePerPost == 1) {
                    $registry->session->message['txt'] = $registry->option->errorMessage->reviewLimitError;
                    $registry->session->message['type'] = 'error';
                }
            // this else will redirect the user if he's not logged in
			} elseif (!isset($loggedUserId['username'])) {
				// header('Location: '.$registry->configuration->website->params->url. '/user/register');
				$registry->session->message['txt'] = $registry->option->errorMessage->reviewError;
				$registry->session->message['type'] = 'error';
			}
		}
        // logged user
        $user=$registry->session->user->id ?? null;

            if (isset($user) && !empty($user)) {
                $wishList = $productModel->getTheWishlist($id, $user);
            } else {
                $wishList = $productModel->getTheWishlist($id, $user=0);
            }

        $productView->showWishList('show', $wishList);
		// shows comments on a product
		$productView->showCertainProduct('home_product',$certainProduct, $averageRating, $totalCart);

		// this will show all the comments and total likes for a specific product
		$allCommentsForProductView = $productView->showCommentsByProduct('home_product', $allCommentsForProduct, $page, $totalLikes, $totalCart);

		break;

	//this case will take you to a certain brand
	case 'brand':
		// get total number of products from cart
		$cart['userId'] = $registry->session->user->id ?? 0;
		$totalCart = $productModel->sumProductsFromCart($cart['userId']);

		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		$id = $registry->request['id'];

		// this variable will use the function to get the Product By Brand using the given id and page(for paginaton)
		$productByBrand = $productModel->getProductByBrand($id,$page);

		$productView->showCertainBrand('home_brand',$productByBrand, $page, $totalCart);

		break;

	//this case will take you to a certain category
	case 'category':
		// get total number of products from cart
		$cart['userId'] = $registry->session->user->id ?? 0;
		$totalCart = $productModel->sumProductsFromCart($cart['userId']);
		
		// this is the variable responsable with the page number
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		$id = $registry->request['id'];

		// this variable will use the function to get the Product By Category using the given id and page(for paginaton)
		$productByCategory = $productModel->getProductByCategory($id,$page);

		$productView->showCertainCategory('home_category',$productByCategory, $page, $totalCart);
		break;

	//this case will take you to the about page
	case 'about':
		// get total number of products from cart
		$cart['userId'] = $registry->session->user->id ?? 0;
		$totalCart = $productModel->sumProductsFromCart($cart['userId']);

		$productView->showPage($registry->requestAction,$totalCart);
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

			$registry->session->message['txt'] = $registry->option->infoMessage->addLike;
			$registry->session->message['type'] = 'info';

			exit();
		} else {
			$registry->session->message['txt'] = $registry->option->errorMessage->voteError;
			$registry->session->message['type'] = 'error';
		}
		// an if that checks for the action an value
		if ($action == 'downVote' && $userId != "" && $_POST['info'] == '-1') {
			$response['action'] = $action;
			$response['data']['voteValue'] = --$value;
			$response['success'] = true;
			$response['message'] = "DOWN Successfull";
			$update = $productModel->voteACertainComment($value, $id, $userId);
			echo Zend_Json::encode($response);

			$registry->session->message['txt'] = $registry->option->infoMessage->addDislike;
			$registry->session->message['type'] = 'info';
			
			exit();
		} else {
			$registry->session->message['txt'] = $registry->option->errorMessage->voteError;
			$registry->session->message['type'] = 'error';
		}
		echo Zend_Json::encode($response);
		exit();
		break;

	// this case is meant to delete the user's comment
	case 'delete_user_comment':
		$loggedUserId = (array)$_SESSION['frontend']['user'];
	// user id from session
		$loggedUser = $loggedUserId['id'];
	// comment id from tpl
		$commentId = $_POST['id'];
	// comment userId from tpl
		$userId = $_POST['userId'];
	// delete action
		$action = $_POST['action'] ?? 'error';

		$response = [
					'success' => false,
					'message' => 'invalid action provided',
					'action' => 'error',
					'data' => [
						'voteValue' => ''
				 	],
		];
		if (isset($loggedUser) && !empty($loggedUser)) {
			if ($action == 'delete' && $loggedUser == $userId) {
				$response['action'] = $action;
				$response['success'] = true;
				$response['message'] = "Delete Successfull";
				$delete = $productModel->deleteCommentToCertainProduct($commentId, $loggedUser);
				echo Zend_Json::encode($response);
				// validation info (you have deleted your review)
				$registry->session->message['txt'] = $registry->option->infoMessage->deleteReview;
				$registry->session->message['type'] = 'info';
				exit();
			} else {
				// validation error (you can't delete a comment that's not yours)
				echo Zend_Json::encode($response);
				$registry->session->message['txt'] = $registry->option->errorMessage->deleteError;
				$registry->session->message['type'] = 'error';
				// header('Location: '.$registry->configuration->website->params->url. '/user/'.'register');
				exit();
			}
		} else {
			// validation error (you can't delete comments while you are not logged)
			echo Zend_Json::encode($response);
			$registry->session->message['txt'] = $registry->option->errorMessage->deleteLogError;
			$registry->session->message['type'] = 'error';
			exit();
		}
		break;

    case 'add_to_wishlist':
        $loggedUserId = (array)$_SESSION['frontend']['user'];
        // user id from session
        $loggedUser = $loggedUserId['id'];
        // product id from tpl
        $productId = $_POST['productId'];
        // validation
        $valid = $_POST['validation'];
        // delete action
        $action = $_POST['action'] ?? 'error';

        $response = [
            'success' => false,
            'message' => 'invalid action provided',
            'action' => 'error'
        ];
        if (isset($loggedUser) && !empty($loggedUser)) {
            if ($action == 'addToWish'  && $valid == 1 && $maxProductsInWishlist == 0) {
                $response['action'] = $action;
                $response['success'] = true;
                $response['message'] = "Added Successfull";
                $maxProductsInWishlist=$productModel->addProductToWishlist($productId, $loggedUser, $valid);
                // this if test if the product was already added to the wishlist
                if ($maxProductsInWishlist >= 1) {
                    // validation error (you can't add a product to your wishlist more than once)
                    echo Zend_Json::encode($response);
                    $registry->session->message['txt'] = $registry->option->errorMessage->AddToWishlistError;
                    $registry->session->message['type'] = 'error';
                    exit();
                }
                echo Zend_Json::encode($response);
                // validation info (you have added a product to the wishlist)
                $registry->session->message['txt'] = $registry->option->infoMessage->AddToWishlist;
                $registry->session->message['type'] = 'info';
                exit();
            } if ($maxProductsInWishlist >= 1) {
                // validation error (you can't add a product to your wishlist more than once)
                echo Zend_Json::encode($response);
                $registry->session->message['txt'] = $registry->option->errorMessage->AddToWishlistError;
                $registry->session->message['type'] = 'error';
                exit();
            }
        } else {
            // validation error (you can't add products in the wishlist while you are not logged)
            echo Zend_Json::encode($response);
            $registry->session->message['txt'] = $registry->option->errorMessage->AddToWishlistLogError;
            $registry->session->message['type'] = 'error';
//            header('Location: '.$registry->configuration->website->params->url. '/user/'.'register');
            exit();
        }
        break;

    case "edit_user_comment":
        var_dump($_POST);
        $loggedUserId = (array)$_SESSION['frontend']['user'];
        // user id from session
        $loggedUser = $loggedUserId['id'];
        // product id from tpl
        $productId = $_POST['productId'];
        // edit action
        $action = $_POST['action'] ?? 'error';

        $response = [
            'success' => false,
            'message' => 'invalid action provided',
            'action' => 'error'
        ];
        if (isset($loggedUser) && !empty($loggedUser)) {
            if ($action == 'addToWish' && $valid == 1 && $maxProductsInWishlist == 0) {
                $response['action'] = $action;
                $response['success'] = true;
                $response['message'] = "Edited Successfull";
                $productModel->editCommentToCertainProduct($data, $commentId, $userId);
            } else {
                // validation error (you can't add products in the wishlist while you are not logged)
                echo Zend_Json::encode($response);
                $registry->session->message['txt'] = $registry->option->errorMessage->editError;
                $registry->session->message['type'] = 'error';
//            header('Location: '.$registry->configuration->website->params->url. '/user/'.'register');
                exit();
            }
        }
        break;
}