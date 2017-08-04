<?php

class Article_View extends View {
	/**
	 * Constructor
	 * @access public
	 * @param Dot_Template $tpl
	 */
	public function __construct($tpl)
	{
		$this->tpl = $tpl;
		$this->settings = Zend_Registry::get('settings');
	}

public function showArticle($template= '', $data){
	if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'article/'.$this->template.'.tpl');
		$this->tpl->setBlock('tpl_main', 'article_list', 'article_list_block');

		foreach ($data as $article) {
			foreach ($article as $key => $value) {
				
				$this->tpl->setVar(strtoupper($key), $value);
			}
			$this->tpl->parse('article_list_block', 'article_list', true);
		}
	}
	public function showArticleContent($template = '', $data)
	{
		if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'article/'.$this->template.'.tpl');
		
		foreach ($data as $key => $value) {
			$this->tpl->setVar(strtoupper($key), $value);
		}
	}
	
}
