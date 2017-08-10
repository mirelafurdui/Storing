<?php
$productModel= new Product();
$productView= new Product_View($tpl);
$pageTitle = $option->pageTitle->action->{$registry->requestAction};

switch ($registry->requestAction) {
	default:
	case 'list':
		$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		$list = $productModel->getProductList($page);
		
		$product = $productView->showProductList('product_list', $list, $page);
		break;

	case 'add':

		$category = $productModel->selectCategory(); 
		$product = $productView->showDataCategory('product_add', $category);
		$brand = $productModel->selectBrand(); 
		$product1 = $productView->showDataBrand('product_add', $brand);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data['name'] = (isset($_POST['name'])) ? $_POST['name']:'';
			$data['idCategory'] = (isset($_POST['idCategory'])) ? $_POST['idCategory']:'';
			$data['idBrand'] = (isset($_POST['idBrand'])) ? $_POST['idBrand']:'';
			$data['description'] = (isset($_POST['description'])) ? $_POST['description']:'';
			$data['stoc'] = (isset($_POST['stoc'])) ? $_POST['stoc']:'';
			$data['price'] = (isset($_POST['price'])) ? $_POST['price']:'';
			
			$target_dir = "images/uploads/";
			$filename = md5(microtime());

			$imageFileType = pathinfo($_FILES["image"]['name'],PATHINFO_EXTENSION);	
			
			if($imageFileType == 'jpeg' || $imageFileType == 'jpg' || $imageFileType == 'JPG' || $imageFileType == 'JPEG'){
				$data['image'] = $filename . '.' . $imageFileType;
				move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename . '.' . $imageFileType);
				$productModel->addProduct($data);
			}
		}
		break;
			//add category in DB
	case 'category':
		$category = $productModel->selectCategory();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$ok = false;
			$ok1 = false;
			foreach ($category as $key) {
				foreach ($key as $brandKey => $value) {
					if ($value == $_POST['name']) {
						$ok = true;
					}
					if ($_POST['name'] =="") {
						$ok1 = true;
					}
					
				}
			}
			if (!$ok && !$ok1) {
				$productModel->addData($_POST,'category');
			//view confirmation message
				$registry->session->message['txt'] = $registry->option->infoMessage->addCategory;
				$registry->session->message['type'] = 'info';
			}elseif($ok) {
				$registry->session->message['txt'] = $registry->option->errorMessage->addCategoryError;
				$registry->session->message['type'] = 'error';
			}elseif($ok1) {
				$registry->session->message['txt'] = $registry->option->errorMessage->addCategoryError1;
				$registry->session->message['type'] = 'error';
			}
		}
		$productView->showDataCategory('add_category', $category);
		break;
			//add brand in DB
	case 'brand':
		$brand = $productModel->selectBrand();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$ok = false;
			$ok1 = false;
			foreach ($brand as $key) {
				foreach ($key as $brandKey => $value) {
					if ($value == $_POST['name']) {
						$ok = true;
					}
					if ($_POST['name'] =="") {
						$ok1 = true;
					}
					
				}
			}
			if (!$ok && !$ok1) {
				$productModel->addData($_POST,'brand');
			//view confirmation message
				$registry->session->message['txt'] = $registry->option->infoMessage->addBrand;
				$registry->session->message['type'] = 'info';
			}elseif($ok) {
				$registry->session->message['txt'] = $registry->option->errorMessage->addBrandError;
				$registry->session->message['type'] = 'error';
			}elseif($ok1) {
				$registry->session->message['txt'] = $registry->option->errorMessage->addBrandError1;
				$registry->session->message['type'] = 'error';
			}
		}
		$productView->showDataBrand('add_brand', $brand);
		header('Location: '.$registry->configuration->website->params->url. '/admin/'.$registry->requestController . $registry->requestAction);
				exit;
			break;
		

	case 'delete':
		$id = $registry->request['id'];
		$productView->setTplFileDelete('delete_product',$id);
		if($_SERVER['REQUEST_METHOD'] === "POST")
		{	
			if ("on" == $_POST['confirm'])
			{
				$productModel->deleteProduct($id);
				$registry->session->message['txt'] = $registry->option->infoMessage->delete;
				$registry->session->message['type'] = 'info';
			}else {
				$registry->session->message['txt'] = $registry->option->infoMessage->deleteError;
				$registry->session->message['type'] = 'error';
			}
				header('Location: '.$registry->configuration->website->params->url. '/admin/'.$registry->requestController);
				exit;
		}

		break;
	case 'deleteCategory':
		$id = $registry->request['id'];
		var_dump($id);exit;
		$productView->setTplFileDelete('delete_category',$id);
		if($_SERVER['REQUEST_METHOD'] === "POST")
		{	
			if ("on" == $_POST['confirm'])
			{
				$productModel->deleteData("category",$id);
				$registry->session->message['txt'] = $registry->option->infoMessage->delete;
				$registry->session->message['type'] = 'info';
			}else {
				$registry->session->message['txt'] = $registry->option->infoMessage->deleteError;
				$registry->session->message['type'] = 'error';
			}
				// header('Location: '.$registry->configuration->website->params->url. '/admin/'.$registry->requestController);
				// exit;
		}

		break;

	case 'edit':
		$id = $registry->request['id'];
		$productData = $productModel->getProductById($id);
	//	var_dump($productData);exit;
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//select category and brand from database
			$category = $productModel->selectCategory(); 
			$product = $productView->showDataCategory('product_add', $category);
			$brand = $productModel->selectBrand(); 
			$product1 = $productView->showDataBrand('product_add', $brand);

			$data['name'] = (isset($_POST['name'])) ? $_POST['name']:'';
			$data['description'] = (isset($_POST['description'])) ? $_POST['description']:'';
			$data['stoc'] = (isset($_POST['stoc'])) ? $_POST['stoc']:'';
			$data['price'] = (isset($_POST['price'])) ? $_POST['price']:'';
			
			$target_dir = "images/uploads/";
			$filename = md5(microtime());

			$imageFileType = pathinfo($_FILES["image"]['name'],PATHINFO_EXTENSION);	
			
			if($imageFileType == 'jpeg' || $imageFileType == 'jpg'){
				$data['image'] = $filename . '.' . $imageFileType;
				move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename . '.' . $imageFileType);
			}
				$productModel->updateProductDb($data,$id);
				header('Location: '.$registry->configuration->website->params->url.'/admin/'.$registry->requestController. '/' . $registry->requestAction.'/id/'.$id); exit;
	}

		$productView->showCertainProduct('edit_product',$productData);
		break;
	case 'show':
		$certainProduct = $productModel->getProductById($registry->request['id']);
		$productView->showCertainProduct('product_show',$certainProduct);
		break;
	case 'activate':
			$id = $_POST['id'];
			$isActive = $_POST['isActive'];
			$productModel->activateProduct($id, $isActive);
			$result = array(
				"success" => true,
				"id" => $id,
				"isActive" => intval($isActive)
			);
			echo Zend_Json::encode($result);
		exit;
		break;
}