<?php

class Default_AssetdetailsController extends Zend_Controller_Action
{
	private $options;
	public function preDispatch()
	{
	}

	public function init()
	{
		$this->_options= $this->getInvokeArg('bootstrap')->getOptions();
	}

	public function indexAction()
	{

	}
	public function editAction()
	{
		if(defined('EMPTABCONFIGS'))
		{
			$empOrganizationTabs = explode(",",EMPTABCONFIGS);

			if(in_array('assetdetails',$empOrganizationTabs)){
				$auth = Zend_Auth::getInstance();
				if($auth->hasIdentity())
				{
					$loginUserId = $auth->getStorage()->read()->id;
				}
				$userid = $this->getRequest()->getParam('userid');
				$employeeModal = new Default_Model_Employee();
				$isrowexist = $employeeModal->getsingleEmployeeData($userid);
				if($isrowexist == 'norows')
				$this->view->rowexist = "norows";
				else
				$this->view->rowexist = "rows";

				$empdata = $employeeModal->getActiveEmployeeData($userid);
				if(!empty($empdata))
				{
					$assetcategoriesModel = new Assets_Model_AssetCategories();
				$userassetdata = $assetcategoriesModel->getUserAssetData($userid);
			
				$this->view->userassetdata = $userassetdata;
					if($userid)
					{
						//To display Employee Profile information......
						$usersModel = new Default_Model_Users();
						$employeeData = $usersModel->getUserDetailsByIDandFlag($userid);
					}
					$this->view->id=$userid;
					$this->view->employeedata = $employeeData[0];

					if($this->getRequest()->getPost())
					{
					}
				}
				$this->view->empdata = $empdata;
		 }else{
		 	$this->_redirect('error');
		 }
		}else{
			$this->_redirect('error');
		}
	}


	public function viewAction()
	{
		if(defined('EMPTABCONFIGS'))
		{
			$empOrganizationTabs = explode(",",EMPTABCONFIGS);

		 if(in_array('assetdetails',$empOrganizationTabs)){
		 	$auth = Zend_Auth::getInstance();
		 	if($auth->hasIdentity())
		 	{
		 		$loginUserId = $auth->getStorage()->read()->id;
		 	}
		 	$userid = $this->getRequest()->getParam('userid');
		 	$employeeModal = new Default_Model_Employee();
		 	$isrowexist = $employeeModal->getsingleEmployeeData($userid);
		 	if($isrowexist == 'norows')
		 	$this->view->rowexist = "norows";
		 	else
		 	$this->view->rowexist = "rows";

		 	$empdata = $employeeModal->getActiveEmployeeData($userid);
		 	if(!empty($empdata))
		 	{
				$assetcategoriesModel = new Assets_Model_AssetCategories();
				$userassetdata = $assetcategoriesModel->getUserAssetData($userid);
				$this->view->userassetdata = $userassetdata;
		 		if($userid)
		 		{
		 			//To display Employee Profile information......
		 			$usersModel = new Default_Model_Users();
		 		$employeeData = $usersModel->getUserDetailsByIDandFlag($userid);
			
		 		}
		 		$this->view->id=$userid;
		 		$this->view->employeedata = $employeeData[0];

		 		if($this->getRequest()->getPost())
		 		{
		 		}
		 	}
		 	$this->view->empdata = $empdata;
		 }else{
		 	$this->_redirect('error');
		 }
		}else{
			$this->_redirect('error');
		}
	}
		
}