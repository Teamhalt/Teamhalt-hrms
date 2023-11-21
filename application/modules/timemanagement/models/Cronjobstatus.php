<?php
class Timemanagement_Model_Cronjobstatus extends Zend_Db_Table_Abstract
{
	protected $_name = 'tm_cronjob_status';
	protected $_primary = 'id';

	public function checkCronRunning()
	{
		$select = $this->select()
		->setIntegrityCheck(false)
		->from(array('c'=>$this->_name),array('c.*'))
		->where("c.cronjob_status = 'running'");
		return $this->fetchAll($select)->toArray();

	}

	public function saveorUpdateCronjobStatusData($data, $where)
	{
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