<?php

class Default_Model_Leaverequesthistory extends Zend_Db_Table_Abstract 
{
    protected $_name = 'main_leaverequest_history';
    protected $_primary = 'id';
    
    /*
     * This function is used to save/update data in database.
     * @parameters
     * @data  =  array of form data.
     * @where =  where condition in case of update.
     *
     * returns  Primary id when new record inserted,'update' string when a record updated.
     */
    public function saveOrUpdateLeaveRequestHistory($data, $where)
    {
		if($where != ''){
			$this->update($data, $where);
			return 'update';
		} else {
			$this->insert($data);
			$id=$this->getAdapter()->lastInsertId($this->_name);
			return $id;
		}
	}	//end 
    public function getLeaveRequestHistory($id)
    {
        $history = array();
  		$db = Zend_Db_Table::getDefaultAdapter();
		$where = " e.leaverequest_id = ".$id." AND e.isactive = 1 ";
		$by=" e.createddate desc ";
	    $history = $this->select()
					->setIntegrityCheck(false)
					->from(array('e' => 'main_leaverequest_history'),array('history'=>"concat(e.description,c.userfullname)",'hdate'=>"date(e.createddate)",'htime'=>"time(e.createddate)"))
				    ->joinLeft(array('c'=>'main_users'), 'c.id=e.createdby',array('emp_profile_img'=>'c.profileimg','emp_name'=>'c.userfullname'))	
					->where($where)
					->order($by);
		
    	return  $this->fetchAll($history)->toArray();
     }
	
}//end 
