<?php

class Expenses_IndexController extends Zend_Controller_Action
{
	private $options;

	/**
	 * The default action - show the home page
	 */
	public function preDispatch()
	{
		/*$userModel = new Timemanagement_Model_Users();
		$checkTmEnable = $userModel->checkTmEnable();

		if(!$checkTmEnable){
			$this->_redirect('error');
		}*/
		
		//check Time management module enable
		/* if(!sapp_Helper::checkTmEnable())
			$this->_redirect('error'); */

	}

	public function init()
	{
		$this->_options= $this->getInvokeArg('bootstrap')->getOptions();

	}

	/**
	 * This method will display all the Expense details in grid format.
	 */
	/**
	 * This method will display all the Expense details in grid format.
	 */
	public function indexAction()
	{
		//echo "here";exit;
		$this->_redirect('expenses/expenses');
	}
	
	
}

