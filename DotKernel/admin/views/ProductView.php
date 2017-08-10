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

			foreach ($productData['data'] as $key => $value) {
				foreach ($value as $productK => $productValue) {
					// this will set all the productKeys given to be upper case for it to work with the tpl file
					$this->tpl->setVar(strtoupper($productK), $productValue);
					if (strtoupper($productK) =="ISACTIVE") {
						$this->tpl->setVar('ACTIVE_IMG', $value['isActive'] == 1 ? 'active' : 'inactive');
					}
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

	// this function is meant only to set the tpl file
	public function setTplFile($template = '')
	{
		// tests if the template is not empty
		if ($template != '') {
			// sets the tpl value to be the tpl
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
	}

	// this function will show the template and id specified by $template and $id
	public function setTplFileDelete($template = '',$id)
	{
		// tests if the template is not empty
		if ($template != '') {
			// sets the tpl value to be the tpl
			$this->template = $template;
		}	
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets the id value for $id
		$this->tpl->setVar('ID', $id);
	}
	// this function will show the data from table category
	public function showDataCategory($template = '', $data)
	{
		// tests if the template is not empty
		if ($template != '') {
			// sets the tpl value to be the tpl
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'category', 'category_block');
		// this foreach travels the established table by his keys and values
		foreach ($data as $value) {
			foreach ($value as $key => $productValue) {
				// this will set all the productKeys that have CATEGORY_ given to be upper case for it to work with the tpl file
				$this->tpl->setVar('CATEGORY_'.strtoupper($key), $productValue);
			}
			// this parse is related to the block and if it's true it will show all the keys and values for each block repeat
			// block name "category_block"
			$this->tpl->parse('category_block','category',true);
		}
	}
	// this function will show the data from table brand
	public function showDataBrand($template = '', $data)
	{
		// tests if the template is not empty
		if ($template != '') {
			// sets the tpl value to be the tpl
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'brand', 'brand_block');
		// this foreach travels the established table by his keys and values
		foreach ($data as $value) {
			foreach ($value as $key => $productValue) {
				// this will set all the productKeys that have BRAND_ given to be upper case for it to work with the tpl file
				$this->tpl->setVar('BRAND_'.strtoupper($key), $productValue);
			}
			// this parse is related to the block and if it's true it will show all the keys and values for each block repeat
			// block name "brand_block"
			$this->tpl->parse('brand_block','brand',true);
		}
	}

	public function details($templateFile, $data=array())
	{
		$this->tpl->setFile('tpl_main', 'product/' . $templateFile . '.tpl');
		$this->tpl->setVar('ACTIVE_1', 'checked');
		$this->tpl->addUserToken();
		foreach ($data as $k=>$v)
		{
			$this->tpl->setVar(strtoupper($k), $v);
			if('isActive' == $k)
			{
				$this->tpl->setVar('ACTIVE_'.$v, 'checked');
				$this->tpl->setVar('ACTIVE_'.$v*(-1)+1, '');
			}
		}
		
		//empty because we don't want to show the password
		$this->tpl->setVar('PASSWORD', '');
	}
}