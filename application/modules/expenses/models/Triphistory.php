<?php

class Expenses_Model_Triphistory extends Zend_Db_Table_Abstract
{
	//echo "expensesmodel";exit;
	protected $_name = 'expense_trip_history';
	protected $_primary = 'id';

	/**
	 * This will fetch all the client details based on the search paramerters passed with pagination.
	 *
	 * @param string $sort
	 * @param string $by
	 * @param number $perPage
	 * @param number $pageNo
	 * @param JSON $searchData
	 * @param string $call
	 * @param string $dashboardcall
	 * @param string $a
	 * @param string $b
	 * @param string $c
	 * @param string $d
	 *
	 * @return array
	 */
	

	/**
	 * This method will save or update the trip history details based on the trip id.
	 *
	 * @param array $data
	 * @param string $where
	 */
	public function saveOrUpdateTripHistory($data, $where){
		
		//echo "<pre>";print_r($data);exit;
		if($where != ''){
			$this->update($data, $where);
			return 'update';
		} else {
			$this->insert($data);
			$id=$this->getAdapter()->lastInsertId($this->_name);
			return $id;
		}
	}	
	
	
	public function getTripHistory($trip_id)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$tripData = $this->select()
		->setIntegrityCheck(false)
		->from(array('ex' => 'expense_trip_history'))
		->joinInner(array('mu'=>'main_users'), "mu.id = ex.createdby",array('userfullname'=>'mu.userfullname'))		
		->where('ex.isactive=1 and ex.trip_id='.$trip_id);
		return $this->fetchAll($tripData)->toArray();
	}
	
		
}