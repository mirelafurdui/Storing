<?php
class Product_View extends View
{
	// constructor function for tpl
	public function __construct($tpl)
	{
		$this->tpl = $tpl;
		$this->settings = Zend_Registry::get('settings');
		$this->session = Zend_Registry::get('session');
	}
	// this function makes the pagination,sets the tpl file and block while it shows the table using foreach
	public function showProductList($template='', $productData, $page)
	{
		if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		$this->tpl->setBlock('tpl_main', 'product_list', 'product_list_block');
		$this->tpl->paginator($productData['pages']);
		$this->tpl->setVar('PAGE',$page);

			foreach ($productData['data'] as $key => $value) {
				foreach ($value as $productK => $productValue) {
					$this->tpl->setVar(strtoupper($productK), $productValue);
				}
				$this->tpl->parse('product_list_block','product_list',true);
			}
	}
	// this function sets the tpl and shows the table based for one id
	public function showCertainProduct($template='', $productData)
	{
		if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		foreach ($productData as $productKey => $productValue) {
			$this->tpl->setVar(strtoupper($productKey), $productValue);
		}
	}
}