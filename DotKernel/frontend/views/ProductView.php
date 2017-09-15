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
	public function showProductList($template='', $productData, $page, $cartSum)
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
		// sets the number of products from the cart
		$this->tpl->setVar('CARTSUM', $cartSum);
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
	public function showCategoryList($template='', $categoryData, $page, $cartSum)
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
		// sets the number of products from the cart
		$this->tpl->setVar('CARTSUM', $cartSum);
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
	public function showBrandList($template='', $brandData, $page, $cartSum)
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
		// sets the number of products from the cart
		$this->tpl->setVar('CARTSUM', $cartSum);
			// this foreach travels the established table by his keys and values
			foreach ($brandData['data'] as $key => $value) {
				foreach ($value as $productK => $productValue) {
					// this will set all the productKeys given to be upper case for it to work with the tpl file
					$this->tpl->setVar(strtoupper($productK), substr($productValue,0,150));
				}
				// this parse is related to the block and if it's true it will show all the keys and values for each block repeat
				// block name "brand_list"
				$this->tpl->parse('brand_list_block','brand_list',true);
			}
	}

	// this function sets the tpl and shows the table based for one id
	public function showCertainProduct($template='', $productData, $rating, $cartSum)
	{	
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		// sets the number of products from the cart
		$this->tpl->setVar('CARTSUM', $cartSum);
		// this foreach travels the established table by his keys and values
		foreach ($productData as $productKey => $productValue) {
			// this will set all the productKeys given to be upper case for it to work with the tpl file
			$this->tpl->setVar(strtoupper("PRODUCT_".$productKey), $productValue);
		}
		//this foreach will represent the average
			$this->tpl->setVar("AVERAGERATING", $rating);
	}

	// this function sets the tpl and shows the table based on the brand id and adds paginator
	public function showCertainBrand($template='', $productData, $page, $cartSum)
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
		// sets the number of products from the cart
		$this->tpl->setVar('CARTSUM', $cartSum);
		// this foreach travels the established table by his keys and values
		foreach ($productData['data'] as $product) {
			foreach ($product as $key => $value) {
				// this will set all the productKeys given to be upper case for it to work with the tpl file
				$this->tpl->setVar(strtoupper($key), substr($value,0,150));
			}
		$this->tpl->parse('product_brand_list_block','product_brand_list',true);
		}
	}

	// this function sets the tpl and shows the table based on the category id and adds paginator
	public function showCertainCategory($template='', $productData, $page, $cartSum)
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
		// sets the number of products from the cart
		$this->tpl->setVar('CARTSUM', $cartSum);
		// this foreach travels the established table by his keys and values
		foreach ($productData['data'] as $product) {
			foreach ($product as $key => $value) {
				// this will set all the productKeys given to be upper case for it to work with the tpl file
				$this->tpl->setVar(strtoupper($key), substr($value,0,150));
			}
		$this->tpl->parse('product_category_list_block','product_category_list',true);
		}
	}

	// shows the about page for the moment
	public function showPage($templateFile = '',$cartSum)
	{
		if ($templateFile != '') $this->templateFile = $templateFile;//in some cases we need to overwrite this variable
		$this->tpl->setFile('tpl_main', 'product/' . $this->templateFile . '.tpl');
		// sets the number of products from the cart
		$this->tpl->setVar('CARTSUM', $cartSum);
	}

    // shows the all the comments for a certain product
	public function showCommentsByProduct($template='', $commentList, $page, $likes, $cartSum)
	{	
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'product/'.$this->template.'.tpl');
		
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'user_comment', 'user_comment_block');

		// sets block etc
		$this->tpl->setBlock('user_comment', 'user_action_logged', 'user_action_logged_block');
		
		// sets the pagination that will be shown later on in the tpl file
		$this->tpl->paginator($commentList['pages']);
		
		// sets the page variable to be shown later on in the tpl file
		$this->tpl->setVar('PAGE',$page);
		// sets the number of products from the cart
		$this->tpl->setVar('CARTSUM', $cartSum);
		
		// this foreach travels the established table by his keys and values
		foreach ($commentList['data'] as $comment) {
            $this->tpl->parse('user_action_logged_block','');
			foreach ($comment as $key => $value) {
				// this will set all the productKeys given to be upper case for it to work with the tpl file
				$this->tpl->setVar(strtoupper("COMMENT_".$key), $value);
				
				// this is the set point for each radio input
				$this->tpl->setVar('CHECK_1', '');
				$this->tpl->setVar('CHECK_2', '');
				$this->tpl->setVar('CHECK_3', '');
				$this->tpl->setVar('CHECK_4', '');
				$this->tpl->setVar('CHECK_5', '');
				
				// this is the set value to make the start be checked
				$this->tpl->setVar('CHECK_'.$comment['rating'], 'checked');

			}
				// this foreach will represent the total number of likes
            $totalLikes=0;
			foreach ($likes as $key => $totalLikes) {
				if($key == $comment['id']) {
					$this->tpl->setVar('LIKES', $totalLikes);

				}
			}
			    // this if will check if the session user is set
			if (isset($this->session->user->id))
            {
                // if the session user is set then it will check if the user has a review
                if ($this->session->user->id == $comment['userId'])
                {
                    $this->tpl->setVar("COMMENT_ID", $comment['id']);
                    $this->tpl->setVar("COMMENT_USERID", $comment['userId']);
                    $this->tpl->parse('user_action_logged_block','user_action_logged',true);
                }
            }

			$this->tpl->parse('user_comment_block','user_comment',true);
		}
	}

	// shows the wishlist
    public function showWishList($template='', $wishList)
    {
        // tests if the template is not empty
        if ($template != '') {
            $this->template = $template;
        }
        // sets the tpl file
        // $this->tpl->setFile('tpl_main', 'user/'.$this->template.'.tpl');
        // this will set all the productKeys given to be upper case for it to work with the tpl file

        $this->tpl->setVar("WISHLIST", $wishList);
    }
}