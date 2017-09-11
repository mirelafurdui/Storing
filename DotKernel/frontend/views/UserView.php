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

class User_View extends View
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

	/**
	 * Display the login form
	 * @access public
	 * @param string $templateFile
	 * @return void
	 */
	public function loginForm($templateFile)
	{
		$this->tpl->setFile('tpl_main', 'user/' . $templateFile . '.tpl');
		$session = Zend_Registry::get('session');
		if(isset($session->validData))
		{
			foreach ($session->validData as $k=>$v)
			{
				$this->tpl->setVar(strtoupper($k),$v);
			}
		}
		unset($session->validData);
	}

	/**
	 * Display the password reset form 
	 * @access public
	 * @param string $templateFile
	 * @param bool $disabled
	 * @param integer $userId
	 * @param string $userToken
	 * @return void
	 */
	public function resetPasswordForm($templateFile, $disabled = true, $userId, $userToken)
	{
		$this->tpl->setFile('tpl_main', 'user/' . $templateFile . '.tpl');
		if(false == $disabled)
		{
			$this->tpl->setVar('USERTOKEN', $userToken);
			$this->tpl->setVar('USERID', $userId);
			$this->tpl->setVar('DISABLED', 'submit');
		}
		else 
		{
			$this->tpl->setVar('DISABLED', 'hidden');
		}
	}

	/**
	 * Display user's signup form
	 * @access public
	 * @param string $templateFile
	 * @param array $data [optional]
	 * @return void
	 */
	public function details($templateFile, $data=array())
	{
		$this->tpl->setFile('tpl_main', 'user/' . $templateFile . '.tpl');
		foreach ($data as $k=>$v)
		{
			$this->tpl->setVar(strtoupper($k), $v);
		}
		if('add' == $templateFile)
		{
			$this->tpl->setVar('SECUREIMAGE',$this->getRecaptcha()->getHTML());
		}
		if('update' == $templateFile)
		{
			$this->tpl->addUserToken();
		}
		
		//empty because we don't want to show the password
		$this->tpl->setVar('PASSWORD', '');
	}
		// shows the about page for the moment
	public function showPage($templateFile = '')
	{
		if ($templateFile != '') $this->templateFile = $templateFile;//in some cases we need to overwrite this variable
		$this->tpl->setFile('tpl_main', 'user/' . $this->templateFile . '.tpl');
	}
	// this function makes sets the tpl file and block while it shows the table using foreach
	public function showWishList($template='', $wishList)
	{
		// tests if the template is not empty
		if ($template != '') {
			$this->template = $template;
		}
		// sets the tpl file
		// $this->tpl->setFile('tpl_main', 'user/'.$this->template.'.tpl');
		// sets block that will later be repeated
		$this->tpl->setBlock('tpl_main', 'wishlist_list', 'wishlist_list_block');
		foreach ($wishList as $key => $value) {
			foreach ($value as $productK => $productValue) {
				// this will set all the productKeys given to be upper case for it to work with the tpl file
				$this->tpl->setVar("WISHLIST_".strtoupper($productK),$productValue);
			}
		// this parse is related to the block and if it's true it will show all the keys and values for each block repeat
		// block name "wishlist_list"
		$this->tpl->parse('wishlist_list_block','wishlist_list',true);
		}
	}
}
