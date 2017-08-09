<?php
class Product_View extends View
{
	// constructor function for tpl
	public function __construct($tpl)
	{
		$this->tpl = $tpl;
		// gets settings
		$this->settings = Zend_Registry::get('settings');
		// gets session
		$this->session = Zend_Registry::get('session');
	}

	// this function makes the pagination,sets the tpl file and block while it shows the table using foreach
	public function showProductList($template='', $productData, $page)
	{
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'product_list', 'product_list_block');
		// sets the pagination that will be shown later on in the tpl file
		$this->tpl->paginator($productData['pages']);
		// sets the page variable to be shown later on in the tpl file
		$this->tpl->setVar('PAGE',$page);
			// this foreach travels the established table by his keys and values
			foreach ($productData['data'] as $key => $value) {
				foreach ($value as $productK => $productValue) {
					// this will set all the productKeys given to be upper case for it to work with the tpl file
					$this->tpl->setVar(strtoupper($productK), $productValue);
				}
				// this parse is related to the block and if it's true it will show all the keys and values for each block repeat
				// block name "product_list_block"
				$this->tpl->parse('product_list_block','product_list',true);
			}
	}

	// this function sets the tpl and shows the table based for one id
	public function showCertainProduct($template='', $productData)
	{	
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// this foreach travels the established table by his keys and values
		foreach ($productData as $productKey => $productValue) {
			// this will set all the productKeys given to be upper case for it to work with the tpl file
			$this->tpl->setVar(strtoupper($productKey), $productValue);
		}
	}
	public function showPage($templateFile = '')
	{
		if ($templateFile != '') $this->templateFile = $templateFile;//in some cases we need to overwrite this variable
		$this->tpl->setFile('tpl_main', 'product/' . $this->templateFile . '.tpl');
	}
}