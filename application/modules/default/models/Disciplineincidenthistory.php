<?php

class Default_Model_Disciplineincidenthistory extends Zend_Db_Table_Abstract 
{
    protected $_name = 'main_disciplinary_history';
    protected $_primary = 'id';
    
    /*
     * This function is used to save/update data in database.
     * @parameters
     * @data  =  array of form data.
     * @where =  where condition in case of update.
     *
     * returns  Primary id when new record inserted,'update' string when a record updated.
     */
    public function saveOrUpdateDisciplineIncidentHistory($data, $where)
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
    public function getDisciplineIncidentHistory($id)
    {
        $history = array();
  		$db = Zend_Db_Table::getDefaultAdapter();
		$where = " e.incident_id = ".$id." ";
		$by=" e.createddate desc ";
	    $history = $this->select()
					->setIntegrityCheck(false)
					->from(array('e' => 'main_disciplinary_history'),array('history'=>"concat(e.description,c.userfullname)",'hdate'=>"date(e.createddate)",'htime'=>"time(e.createddate)"))
				    ->joinLeft(array('c'=>'main_users'), 'c.id=e.action_emp_id',array('emp_profile_img'=>'c.profileimg','emp_name'=>'c.userfullname'))	
					->where($where)
					->order($by);
    	return  $this->fetchAll($history)->toArray();
     }
	
}//end 
