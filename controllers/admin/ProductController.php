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
			$data['pret'] = (isset($_POST['pret'])) ? $_POST['pret']:'';
			
			$target_dir = "images/uploads/";
			$filename = md5(microtime());

			$imageFileType = pathinfo($_FILES["image"]['name'],PATHINFO_EXTENSION);	
			
			if($imageFileType == 'jpeg' || $imageFileType == 'jpg'){
				$data['image'] = $filename . '.' . $imageFileType;
				move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename . '.' . $imageFileType);
				$productModel->addProduct($data);
			}
		}
		break;

	case 'category':
			$category = $productView->setTplFile('add_category');
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$productModel->addData($_POST,'category');
		}
		break;

	case 'brand':
		$category = $productView->setTplFile('add_brand');
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$productModel->addData($_POST,'brand');
		}
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
			}
				header('Location: '.$registry->configuration->website->params->url. '/admin/'.$registry->requestController);
				exit;
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
			$data['pret'] = (isset($_POST['pret'])) ? $_POST['pret']:'';
			
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
}