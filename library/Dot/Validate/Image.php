<?php
/**
 * DotBoost Technologies Inc.
 * DotKernel Application Framework
 *
 * @category   DotKernel
 * @copyright  Copyright (c) 2009-2015 DotBoost Technologies Inc. (http://www.dotboost.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    $Id: User.php 980 2015-06-11 13:38:03Z gabi $
 */

/**
 * Validate User
 * @category   DotKernel
 * @package    DotLibrary
 * @subpackage DotValidate
 * @see		   Dot_Validate
 * @author     DotKernel Team <team@dotkernel.com>
 */

class Dot_Validate_Image extends Dot_Validate
{
    /**
     * Validate user options
     * Is an array with the following keys
     * 			- who: string - for which type of user the validation is made (user, admin, ...)
     * 			- action: string - from which action is called the validation(login, add, update, activate, ...)
     * 			- values: array - what should validate
     * 			- userId: integer - used for checking the uniqueness of the user(by username or email)
     * @var array
     * @access private
     */
    private $_options = array('who' => 'user',
        'action' => '',
        'values' => array(),
        'userId' => 0);
    /**
     * Valid data after validation
     * @var array
     * @access private
     */
    private $_data = array();
    /**
     * Errors found on validation
     * @var array
     * @access private
     */
    private $_error = array();

    private $_supportedImages = [
        'image/png',
        'image/jpeg',
        'image/gif'
    ];

    /**
     * Constructor
     * @access public
     * @param array $options [optional]
     * @return Dot_Validate
     */
    public function __construct($options = array())
    {
        $this->option = Zend_Registry::get('option');
        foreach ($options as $key =>$value)
        {
            $this->_options[$key] = $value;
        }
    }

    /**
     * Check if data is valid
     * @access public
     * @param $image
     * @return bool
     */
    public function isValid($image = null)
    {
        $this->_data = array();
        $this->_error = array();
        $values = $this->_options['values'];

        // if the image has content then we will give $value the content
        if ($image != null) {
            $values = $image;
        }

        $callbackValidator = new Zend_Validate_Callback(array(
            'callback' => array('Dot_Validate_Image', 'array_keys_exist'),
            'options'  => [['name', 'type', 'tmp_name', 'error', 'size']],
        ));

        if ($callbackValidator->isValid($values) !== true) {
            $this->_error['invalid_upload'] = 'Upload format not valid';
            return false;
        }

        // call filter only accepts array for each key
        foreach ($values as $key => $value) {
            $values[$key] = [$value];
        }

        // validation for the name
        $validatorChain = new Zend_Validate();
        $validatorChain->addValidator(new Zend_Validate_StringLength(['min' => 1]));
        $this->_callFilter($validatorChain,$values['name']);

        // validation for the type
        $validatorChain = new Zend_Validate();
        $validatorChain->addValidator(new Zend_Validate_InArray($this->_supportedImages));
        $this->_callFilter($validatorChain,$values['type']);

        // validation for the existance of the file
        $validatorChain = new Zend_Validate();
        $validatorChain->addValidator(new Zend_Validate_Callback('file_exists'));
        # $validatorChain->addValidator(new Zend_Validate_File_Exists(['/var/www/html']));
        $this->_callFilter($validatorChain,$values['tmp_name']);

        // validation for errors
        $validatorChain = new Zend_Validate();
        $validatorChain->addValidator(new Zend_Validate_StringLength(['max'=>'0']));
        $this->_callFilter($validatorChain,$values['error']);

        // validation for size
        $validatorChain = new Zend_Validate();
        $validatorChain->addValidator(new Zend_Validate_Between([
                'min'=> 1024,
                'max'=> 2097152 #2*1024*1024
            ]
        ));
        // this will merge the error with the main validation error (in case they exist)
        $this->_callFilter($validatorChain,$values['size']);

        if(empty($this->_error))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    /**
     * Get valid data
     * @access public
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }
    /**
     * Get errors encounter on validation
     * @access public
     * @return array
     */
    public function getError()
    {
        return $this->_error;
    }

    /**
     * Call filter method from DotFilter
     * @access private
     * @param Zend_Validate $validator
     * @param array $values
     * @return void
     */
    private function _callFilter($validator, $values)
    {
        $dotFilter = new Dot_Filter(array('validator' => $validator, 'values' => $values));
        $dotFilter->filter();
        $this->_data = array_merge($this->_data, $dotFilter->getData());
        $this->_error = array_merge($this->_error, $dotFilter->getError());
    }

    /**
     * Returns true if all keys exist
     * @param $keys
     * @param $array
     * @return bool
     */
    public static function array_keys_exist($array, $keys)
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $array)) {
                return false;
            }
        }
        return true;
    }
}
