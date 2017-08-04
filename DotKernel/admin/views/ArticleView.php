<?php 

class Article_View extends View
{
	/**
	 * Constructor
	 */
	public function __construct($tpl)
	{
		$this->tpl = $tpl;
		$this->settings = Zend_Registry::get('settings');
		$this->session = Zend_Registry::get('session');
	}

	public function showArticle($template = '', $data, $page)
	{
		if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'article/'.$this->template.'.tpl');
		$this->tpl->setBlock('tpl_main', 'article_list', 'article_list_block');
		$this->tpl->paginator($data['pages']);
		$this->tpl->setVar('PAGE',$page);

			foreach ($data['data'] as $key => $value) {
				foreach ($value as $artK => $artValue) {
					$this->tpl->setVar(strtoupper($artK), $artValue);
				}
				$this->tpl->parse('article_list_block','article_list',true);
			}
		
		
	}

	public function addArticleForm($template = '')
	{
		
		if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'article/'.$this->template.'.tpl');

	}
	public function addDeleteForm($template = '',$id)
	{
		
		if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'article/'.$this->template.'.tpl');
		$this->tpl->setVar('ID',$id);
	}

	public function showArticleContent($template = '', $data)
	{
		if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'article/'.$this->template.'.tpl');
		
		foreach ($data as $key => $value) {
			$this->tpl->setVar(strtoupper($key), substr($value, 0, 50));
			
		}
	}
	public function showArticleEdit($template = '', $data)
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
