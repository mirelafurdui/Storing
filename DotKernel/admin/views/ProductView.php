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

	public function setTplFile($template = '')
	{
		if ($template != '') {
			$this->template = $template;
		}	
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');	
	}

	public function showDataCategory($template = '', $data)
	{
		if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		$this->tpl->setBlock('tpl_main', 'category', 'product_add_block');

			foreach ($data as $value) {
				foreach ($value as $key => $productValue) {
					
					$this->tpl->setVar('CATEGORY_'.strtoupper($key), $productValue);
				}
				$this->tpl->parse('product_add_block','category',true);
			}
	}

	public function showDataBrand($template = '', $data)
	{
		if ($template != '') {
			$this->template = $template;
		}
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		$this->tpl->setBlock('tpl_main', 'brand', 'product_add_block1');

			foreach ($data as $value) {
				foreach ($value as $key => $productValue) {
					
					$this->tpl->setVar('BRAND_'.strtoupper($key), $productValue);
				}
				$this->tpl->parse('product_add_block1','brand',true);
			}
	}
}