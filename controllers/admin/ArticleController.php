<?php 

$articleModel = new Article();
$articleView = new Article_View($tpl);
$pageTitle = $option->pageTitle->action->{$registry->requestAction};

switch ($registry->requestAction) {
	default:
	case 'list':
	$page = (isset($registry->request['page']) && $registry->request['page']>0) ? $registry->request['page'] : 1;

		$list = $articleModel->getArticleList($page);
		
		$article = $articleView->showArticle('article_list', $list, $page);
		
		break;
	case 'edit': 
		$id = $registry->request['id'];
		$article = $articleModel->getArticleById($id);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		 $articleModel->updateArticleDb($_POST,$id);
	}

		$articleView->showArticleEdit('edit_article',$article);
		break;
	case 'add':
		$articleView->addArticleForm('add_article');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		 $articleModel->addArticleDb($_POST);
	}
		break;
	case 'delete':
		$id = $registry->request['id'];
		$article = $articleModel->getArticleById($id);

		if($_SERVER['REQUEST_METHOD'] === "POST")
		{		
				$articleModel->deleteArticle($id);
			
			header('Location: '.$registry->configuration->website->params->url. '/' . 'admin/article/list');
		}
		$articleView->addDeleteForm('delete_article',$id);
		break;
	case 'show':
		$article1 = $articleModel->getArticleById($registry->request['id']);
		$articleView->showArticleContent('article_content',$article1);
		break;
}