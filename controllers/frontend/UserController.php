<?php
/**
 * DotBoost Technologies Inc.
 * DotKernel Application Framework
 *
 * @category   DotKernel
 * @package    Frontend
 * @copyright  Copyright (c) 2009-2015 DotBoost Technologies Inc. (http://www.dotboost.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    $Id: UserController.php 872 2015-01-05 16:34:50Z gabi $
 */

/**
 * User Controller
 * @author     DotKernel Team <team@dotkernel.com>
 */

$session = Zend_Registry::get('session');

// instantiate classes related to User module: model & view
$userModel = new User(Dot_Request::getUserAgent(), Dot_Request::getHttpReffer()); 
$userView = new User_View($tpl);
// all actions MUST set  the variable  $pageTitle
$pageTitle = $option->pageTitle->action->{$registry->requestAction};
switch ($registry->requestAction)
{
	default:
	case 'login':
		if(!isset($session->user))
		{
			// display Login form
			$userView->loginForm('login');
		}
		else
		{
			header('Location: '.$registry->configuration->website->params->url.'/user/account');
			exit;
		}
	break;
	case 'authorize':
		// authorize user login
		if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST))
		{
			// validate the authorization request parameters 
			$values = array('username' => array('username' => $_POST['username']), 
							'password' => array('password' => $_POST['password'])
			);
			$dotValidateUser = new Dot_Validate_User(array('who' => 'user', 'action' => 'login', 'values' => $values));
			if($dotValidateUser->isValid())
			{
				$userModel->authorizeLogin($dotValidateUser->getData());
			}
			else
			{
				$error = $dotValidateUser->getError();
				// login info are NOT VALID
				$txt = array();
				$field = array('username', 'password');
				foreach ($field as $v)
				{
					if(array_key_exists($v, $error))
					{
						 $txt[] = $error[$v];
					}
				}
				$session->validData = $dotValidateUser->getData();
				$session->message['txt'] = $txt;
				$session->message['type'] = 'error';
			}
		}
		else
		{
			$session->message['txt'] = $option->warningMessage->userPermission;
			$session->message['type'] = 'warning';
		}
		header('Location: '.$registry->configuration->website->params->url. '/' . $registry->requestController. '/login');
		exit;
	break;
	case 'account':
		// display My Account page, if user is logged in
		//Dot_Auth::checkIdentity();
		$data = array();
		$error = array();

		
		if($_SERVER['REQUEST_METHOD'] === "POST")
		{
			// changes were made to checkUserToken
			// see: Dot_Auth::checkUserToken($userToken, $userType='admin')
			// see: IndexController.php : $userToken
			if( !Dot_Auth::checkUserToken($userToken, 'user') )
			{
				// remove the identity
				$dotAuth = Dot_Auth::getInstance();
				$dotAuth->clearIdentity('user');
				// warn the user
				$session->message['txt'] = $option->warningMessage->tokenExpired; 
				$session->message['type'] = 'warning';
				// log in 
				header('Location: '.$registry->configuration->website->params->url. '/' . $registry->requestController. '/login');
				exit;
			}

			// POST values that will be validated
			$values = array('details' => 
							array(
								'firstName'=>(isset($_POST['firstName']) ? $_POST['firstName'] : ''),
								'lastName'=>(isset($_POST['lastName']) ? $_POST['lastName'] : '')),
								'city'=>(isset($_POST['city']) ? $_POST['city'] : ''),
                                'address'=>(isset($_POST['address']) ? $_POST['address'] : ''),
								'email' => array('email' => (isset($_POST['email']) ? $_POST['email'] : '')
							)
					);
			// Only if a new password is provided we will update the password field
			if($_POST['password'] != '' || $_POST['password2'] !='' )
			{
				$values['password'] = array('password' => $_POST['password'],
								 										'password2' =>  $_POST['password2']);
			}
			
			$dotValidateUser = new Dot_Validate_User(
									array(
										'who' => 'user',
										'action' => 'update',
										'values' => $values,
										'userId' => $registry->session->user->id
									));
			if($dotValidateUser->isValid())
			{
				// no error - then update user
				$data = $dotValidateUser->getData();
				$data['id'] = $registry->session->user->id;

					$target_dir = 'images/uploads/user/';
					$filename = $_POST['email'] . '.jpg';
					$target_file = $target_dir . $filename;
					// var_dump($_FILES["newImage"]);exit;
					move_uploaded_file($_FILES["newImage"]["tmp_name"], $target_file);

                // updates city and address
                $data['city'] = strip_tags($_POST['city']);
                $data['address'] = strip_tags($_POST['address']);

                $userModel->updateUser($data);
				header('Location: '.$registry->configuration->website->params->url . '/user/account/');
				$session->message['txt'] = $option->infoMessage->update;
				$session->message['type'] = 'info';
			}
			else
			{
				$data = $dotValidateUser->getData();
				$session->message['txt'] = $dotValidateUser->getError();
				$session->message['type'] = 'error';
			}
		}
		//create a cart for user
		$cart['userId'] = $registry->session->user->id;
		$cartExist = $userModel->cartExist($cart['userId']);
		if (empty($cartExist)) {
			$userModel->createCart($cart);	
		}

		$data = $userModel->getUserInfo($registry->session->user->id);
		
		// sum for cart
		$data['cartSum'] = $userModel->sumProductsFromCart($cart['userId']);
		$userView->details('update',$data);

		// wishlist

		// logged user
		$userId = $session->user->id;

		// getting wishList for logged user
		$wishList = $userModel->getWishlist($userId);

		// showing wishList
		$userView->showWishList('update', $wishList);
	break;
	case 'register':
		// display signup form and allow user to register
		$data = array();
		$error = array();
		$errorFile = [];
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			if(file_exists($_FILES['image']['tmp_name']))
			{
				foreach ($_FILES['image'] as $key =>$value)
				{
					$validatedImage = validateImage($key,$value);
					if($validatedImage !== true)
					{
						$errorFile[$type] = $validatedImage;
					}
				}
			}
			$values = array('details' => 
								array('firstName'=>(isset($_POST['firstName']) ? $_POST['firstName'] : ''),
									  'lastName'=>(isset($_POST['lastName'])? $_POST['lastName'] : ''),
                                      'city'=>(isset($_POST['city']) ? $_POST['city'] : ''),
                                      'address'=>(isset($_POST['address']) ? $_POST['address'] : ''),
									 ),
							'username' => array('username'=>(isset($_POST['username']) ? $_POST['username'] : '')),
							'email' => array('email' => (isset($_POST['email']) ? $_POST['email'] : '')),
							'password' => array('password' => (isset($_POST['password']) ? $_POST['password'] : ''),
												'password2' =>  (isset($_POST['password2']) ? $_POST['password2'] : '')
											   )
							// 'captcha' => array('recaptcha_challenge_field' => (isset($_POST['recaptcha_challenge_field']) ? $_POST['recaptcha_challenge_field'] : ''),
							// 				   'recaptcha_response_field' => (isset($_POST['recaptcha_response_field']) ? $_POST['recaptcha_response_field'] : ''))
						  );
			$dotValidateUser = new Dot_Validate_User(array('who' => 'user', 'action' => 'add', 'values' => $values));
			if($dotValidateUser->isValid() && empty($errorFile))
			{
				//if there was a picture uploaded and it is not a corupted file then move it to uploads and create the user
					$target_dir = 'images/uploads/user/';
					$filename = $_POST['email'] . '.jpg';
					$target_file = $target_dir . $filename;
					move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
				// no error - then add user
				$data = $dotValidateUser->getData();
				$data['lastName'] = strip_tags(htmlentities($_POST['lastName']));
				$data['firstName'] = strip_tags($_POST['firstName']);
				$data['username'] = strip_tags($_POST['username']);
				$data['city'] = strip_tags($_POST['city']);
				$data['address'] = strip_tags($_POST['address']);
				$data['image'] = $target_file;

				$userModel->addUser($data);
				$session->message['txt'] = $option->infoMessage->add;
				$session->message['type'] = 'info';
				//login user
				$userModel->authorizeLogin($data);
				header('Location: '.$registry->configuration->website->params->url . '/user/account/');
				exit;
			}
			else
			{
				if(array_key_exists('password', $data))
				{
					// do not display password in the add form
					$data = $dotValidateUser->getData();
					unset($data['password']);
				}
				header('location: '.$registry->configuration->website->params->url . '/user/register/');
				exit;
			}
			// add action and validation are made with ajax, so return json string
			// header('Content-type: application/json');  
			// echo Zend_Json::encode(array('data'=>$dotValidateUser->getData(), 'error'=>$dotValidateUser->getError()));
			// return $data and $error as json
		
		}
		$userView->details('add',$data);
	break;
	case 'forgot-password':
		// send an emai with the forgotten password
		$data = array();
		$error = array();
		if($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$values = array('email' => array('email' => (isset($_POST['email']) ? $_POST['email'] : '' )));
			$dotValidateUser = new Dot_Validate_User(array('who' => 'user', 'action' => 'forgot-password', 'values' => $values));
			if($dotValidateUser->isValid())
			{
				// no error - then send password
				$data = $dotValidateUser->getData();
				$userModel->forgotPassword($data['email']);
			}
			else
			{
				$session->message['txt'] = $dotValidateUser->getError();
				$session->message['type'] = 'error';
			}
		}
		$userView->details('forgot_password',$data);
	break;
	case 'reset-password':
		// start by considering there are no errors, and we enable the form 
		$disabled = false;
		
		// not sure if the form was submitted or not yet , either from Request or from POST
		$userId = array_key_exists('id', $registry->request) ? $registry->request['id'] : ((isset($_POST['userId'])) ? $_POST['userId'] : '');
		$userToken = array_key_exists('token', $registry->request) ? $registry->request['token'] : ((isset($_POST['userToken'])) ? $_POST['userToken'] : '');
		
		// get user info based on ID , and see if is valid
		$userInfo = $userModel->getUserInfo($userId);
		if(false == $userInfo)
		{
			$disabled = true;
		}
		else
		{
			// Check if the user's password  match the token 
			$expectedToken = Dot_Auth::generateUserToken($userInfo['password']);
			if($expectedToken != $userToken)
			{
				$disabled = true;
			}
		}
		// we have errors, display the message and disable the form
		if(true == $disabled)
		{
			$session->message['txt'] = $registry->option->errorMessage->wrongResetPasswordUrl;
			$session->message['type'] = 'error';
		}
		// IF the form was submmited and there are NO errors 
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && false == $disabled)
		{
			// POST values that will be validated
			$values['password'] =	array('password' => (isset($_POST['password']) ? $_POST['password'] : ''),
																	'password2' =>  (isset($_POST['password2']) ? $_POST['password2'] : ''));
			$dotValidateUser = new Dot_Validate_User(array(
										'who' => 'user',
										'action' => 'update', 
										'values' => $values, 
										'userId' => $userId
									));
			if($dotValidateUser->isValid())
			{
				$data['password'] = $_POST['password'];
				$data['id'] = $userId;
				$data['username'] = $userInfo['username'];
				$userModel->updateUser($data);
				$userModel->authorizeLogin($data);
			}
			else
			{
				$data = $dotValidateUser->getData();
				$session->message['txt'] = $dotValidateUser->getError();
				$session->message['type'] = 'error';
			}
		}
		// show the form, enabled or disabled 
		$userView->resetPasswordForm('reset_password', $disabled, $userId, $userToken);
	break;
	case 'logout':
		$dotAuth = Dot_Auth::getInstance();
		$dotAuth->clearIdentity('user');
		header('location: '.$registry->configuration->website->params->url);
		exit;
	break;

    // this case is meant to delete products from the wishlist
    case 'delete_product_from_wishlist':
        $loggedUserId = (array)$_SESSION['frontend']['user'];
        // user id from session
        $loggedUser = $loggedUserId['id'];
        // product id from tpl REMAKE
        $productId = $_POST['id'];
        // product userId from tpl
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
                $userModel->deleteProductFromWishlist($productId, $userId);
                echo Zend_Json::encode($response);
                // validation info (you have deleted your product)
                $registry->session->message['txt'] = $registry->option->infoMessage->deleteProductFromWishlist;
                $registry->session->message['type'] = 'info';
                exit();
            } else {
                $registry->session->message['txt'] = $registry->option->infoMessage->login;
                $registry->session->message['type'] = 'error';
                exit();
            }
        }
        echo Zend_Json::encode($response);
//        exit();

        break;
}
	function validateImage($type,$data)
	{
		$errors=[];
		if ($type=="size")
		{
			$allowedSize= 2097152;
			if ($data > $allowedSize)
			{
				$errors[]= "Your Image size $data is too big!";
			}
		}
		if ($type=="type")
		{
			$imageTypes=['image/jpeg' => "image/jpeg"];
			if (!array_key_exists($data, $imageTypes))
			{
				$errors[]= "Your image $type is not allowed!";
			}
		}
		if (count($errors) === 0)
		{
			return true;
		} else {
			return $errors;
		}
	}	