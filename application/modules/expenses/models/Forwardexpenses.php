<?php

class Expenses_Model_Forwardexpenses extends Zend_Db_Table_Abstract
{
	//echo "expensesmodel";exit;
	protected $_name = 'expense_forward';
	protected $_primary = 'id';

	/**
	 * This method will save or update the forwarded expense details.
	 *
	 * @param array $data
	 * @param string $where
	 */
	public function saveOrUpdateForwardData($data, $where){
		
		if($where != ''){
			$this->update($data, $where);
			return 'update';
		} else {
			$this->insert($data);
			$id=$this->getAdapter()->lastInsertId($this->_name);
			return $id;
		}
	}
}