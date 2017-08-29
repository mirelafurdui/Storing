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
					$this->tpl->setVar(strtoupper($productK), substr($productValue,0,150));
				}
				// this parse is related to the block and if it's true it will show all the keys and values for each block repeat
				// block name "product_list"
				$this->tpl->parse('product_list_block','product_list',true);
			}
	}
	
	// this function makes the pagination,sets the tpl file and block while it shows the table using foreach
	public function showCategoryList($template='', $categoryData, $page)
	{
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'category_list', 'category_list_block');
		// sets the pagination that will be shown later on in the tpl file
		$this->tpl->paginator($categoryData['pages']);
		// sets the page variable to be shown later on in the tpl file
		$this->tpl->setVar('PAGE',$page);
			// this foreach travels the established table by his keys and values
			foreach ($categoryData['data'] as $key => $value) {
				foreach ($value as $productK => $productValue) {
					// this will set all the productKeys given to be upper case for it to work with the tpl file
					$this->tpl->setVar(strtoupper($productK), $productValue);
				}
				// this parse is related to the block and if it's true it will show all the keys and values for each block repeat
				// block name "category_list"
				$this->tpl->parse('category_list_block','category_list',true);
			}
	}

	// this function makes the pagination,sets the tpl file and block while it shows the table using foreach
	public function showBrandList($template='', $brandData, $page)
	{
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'brand_list', 'brand_list_block');
		// sets the pagination that will be shown later on in the tpl file
		$this->tpl->paginator($brandData['pages']);
		// sets the page variable to be shown later on in the tpl file
		$this->tpl->setVar('PAGE',$page);
			// this foreach travels the established table by his keys and values
			foreach ($brandData['data'] as $key => $value) {
				foreach ($value as $productK => $productValue) {
					// this will set all the productKeys given to be upper case for it to work with the tpl file
					$this->tpl->setVar(strtoupper($productK), $productValue);
				}
				// this parse is related to the block and if it's true it will show all the keys and values for each block repeat
				// block name "brand_list"
				$this->tpl->parse('brand_list_block','brand_list',true);
			}
	}

	// this function sets the tpl and shows the table based for one id
	public function showCertainProduct($template='', $productData, $rating)
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
			$this->tpl->setVar(strtoupper("PRODUCT_".$productKey), $productValue);
		}
		//this foreach will represent the average
			$this->tpl->setVar("AVERAGERATING", $rating);
	}

	// this function sets the tpl and shows the table based on the brand id and adds paginator
	public function showCertainBrand($template='', $productData, $page)
	{	
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'product_brand_list', 'product_brand_list_block');
		// sets the pagination that will be shown later on in the tpl file
		$this->tpl->paginator($productData['pages']);
		// sets the page variable to be shown later on in the tpl file
		$this->tpl->setVar('PAGE',$page);
		// this foreach travels the established table by his keys and values
		foreach ($productData['data'] as $product) {
			foreach ($product as $key => $value) {
				// this will set all the productKeys given to be upper case for it to work with the tpl file
				$this->tpl->setVar(strtoupper($key), $value);
			}
		$this->tpl->parse('product_brand_list_block','product_brand_list',true);
		}
	}

	// this function sets the tpl and shows the table based on the category id and adds paginator
	public function showCertainCategory($template='', $productData, $page)
	{	
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'product_category_list', 'product_category_list_block');
		// sets the pagination that will be shown later on in the tpl file
		$this->tpl->paginator($productData['pages']);
		// sets the page variable to be shown later on in the tpl file
		$this->tpl->setVar('PAGE',$page);
		// this foreach travels the established table by his keys and values
		foreach ($productData['data'] as $product) {
			foreach ($product as $key => $value) {
				// this will set all the productKeys given to be upper case for it to work with the tpl file
				$this->tpl->setVar(strtoupper($key), $value);
			}
		$this->tpl->parse('product_category_list_block','product_category_list',true);
		}
	}

	// shows the about page for the moment
	public function showPage($templateFile = '')
	{
		if ($templateFile != '') $this->templateFile = $templateFile;//in some cases we need to overwrite this variable
		$this->tpl->setFile('tpl_main', 'product/' . $this->templateFile . '.tpl');
	}

	public function showCommentsByProduct($template='', $productData, $page, $likes)
	{	
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'user_comment', 'user_comment_block');
		// sets the pagination that will be shown later on in the tpl file
		$this->tpl->paginator($productData['pages']);
		// sets the page variable to be shown later on in the tpl file
		$this->tpl->setVar('PAGE',$page);
		// this foreach travels the established table by his keys and values
		foreach ($productData['data'] as $product) {
			foreach ($product as $key => $value) {
				// this will set all the productKeys given to be upper case for it to work with the tpl file
				$this->tpl->setVar(strtoupper("COMMENT_".$key), $value);
			}
				// this foreach will represent the total number of likes
			foreach ($likes as $key => $value) {
				if($key == $product['id']) {
					$this->tpl->setVar('LIKES', $value);
				}
			}
		$this->tpl->parse('user_comment_block','user_comment',true);
		}
	}
}