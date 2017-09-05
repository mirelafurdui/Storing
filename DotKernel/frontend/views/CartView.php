<?php
/**
 * DotBoost Technologies Inc.
 * DotKernel Application Framework
 *
 * @category   DotKernel
 * @copyright  Copyright (c) 2009-2015 DotBoost Technologies Inc. (http://www.dotboost.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    $Id: UserView.php 981 2015-06-11 13:51:41Z gabi $
 */

/**
 * User View Class
 * class that prepare output related to User controller 
 * @category   DotKernel
 * @package    Frontend
 * @author     DotKernel Team <team@dotkernel.com>
 */

class Cart_View extends View
{

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



	// shows the about page for the moment
	public function showPage($templateFile = '')
	{
		if ($templateFile != '') $this->templateFile = $templateFile;//in some cases we need to overwrite this variable
		$this->tpl->setFile('tpl_main', 'cart/' . $this->templateFile . '.tpl');
	}

	// this function makes sets the tpl file and block while it shows the table using foreach
	public function showCartProductList($template='', $productData)
	{
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'cart/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'cart_list', 'cart_list_block');
			// this foreach travels the established table by his keys and values
		$totalPrice = 0;
		$total = 0;
			foreach ($productData as $key => $value) {
					 $priceOk = false; $quantityOk = false;
				foreach ($value as $productK => $productValue) {
					// this will set all the productKeys given to be upper case for it to work with the tpl file
					$this->tpl->setVar(strtoupper($productK),$productValue);
					if ($productK =="price") {
						$totalPrice += $productValue;
						$price = $productValue;
						$priceOk = true;
					}
					if ($productK =="quantity") {
						$quantity = $productValue;
						$quantityOk = true;
					}
					if ($priceOk && $quantityOk) {
						$this->tpl->setVar('PRICE_F',$price*$quantity);
						$total += $price*$quantity;
						$quantityOk = false;
						$priceOk = false;
					}
				}
				// this parse is related to the block and if it's true it will show all the keys and values for each block repeat
				$this->tpl->setVar('TOTAL_PRICE',$total);
				$this->tpl->setVar('TVA',$total*20/100);
				$this->tpl->setVar('TOTAL_PRICE_TVA',$total+($total*20/100));
				// block name "cart_list"
				$this->tpl->parse('cart_list_block','cart_list',true);
			}
	}
public function showUserDetails($template='', $productData)
	{
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		$this->tpl->setFile('tpl_main', 'cart/'.$this->template.'.tpl');
		
			foreach ($productData as $key => $value)
		 	{
				$this->tpl->setVar('USER_'.strtoupper($key),$value);
			}	
			
	}
}