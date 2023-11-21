<?php


class Default_Model_Prefix extends Zend_Db_Table_Abstract
{
    protected $_name = 'main_prefix';
    protected $_primary = 'id';
	
	public function getPrefixData($sort, $by, $pageNo, $perPage,$searchQuery)
	{
		$where = "isactive = 1";
		
		if($searchQuery)
			$where .= " AND ".$searchQuery;
		$db = Zend_Db_Table::getDefaultAdapter();		
		
		$prefixData = $this->select()
    					   ->setIntegrityCheck(false)	    					
						   ->where($where)
    					   ->order("$by $sort") 
    					   ->limitPage($pageNo, $perPage);
		
		return $prefixData;       		
	}
	
	public function getGrid($sort,$by,$perPage,$pageNo,$searchData,$call,$dashboardcall,$a='',$b='',$c='',$d='')
	{		
        $searchQuery = '';
        $searchArray = array();
        $data = array();
		
		if($searchData != '' && $searchData!='undefined')
			{
				$searchValues = json_decode($searchData);
				foreach($searchValues as $key => $val)
				{
					$searchQuery .= " ".$key." like '%".$val."%' AND ";
					$searchArray[$key] = $val;
				}
				$searchQuery = rtrim($searchQuery," AND");					
			}
		$objName = 'prefix';
		
		$tableFields = array('action'=>'Action','prefix' => 'Prefix','description' => 'Description');
		$tablecontent = $this->getPrefixData($sort, $by, $pageNo, $perPage,$searchQuery);     
		
		$dataTmp = array(
			'sort' => $sort,
			'by' => $by,
			'pageNo' => $pageNo,
			'perPage' => $perPage,				
			'tablecontent' => $tablecontent,
			'objectname' => $objName,
			'extra' => array(),
			'tableheader' => $tableFields,
			'jsGridFnName' => 'getAjaxgridData',
			'jsFillFnName' => '',
			'searchArray' => $searchArray,
			'call'=>$call,
			'dashboardcall'=>$dashboardcall
		);	
		return $dataTmp;
	}
	
	public function getsinglePrefixData($id)
	{
		
		$db = Zend_Db_Table::getDefaultAdapter();
		$prefixData = $db->query("SELECT * FROM main_prefix WHERE id = ".$id." AND isactive=1");
		$res = $prefixData->fetchAll();
		if (isset($res) && !empty($res)) 
		{	
			return $res;
		}
		else
			return 'norows';
	}
	
	public function getPrefixList()
	{
	    $select = $this->select()
						->setIntegrityCheck(false)
						->from(array('p'=>'main_prefix'),array('p.id','p.prefix'))
					    ->where('p.isactive = 1')
						 ->order('p.prefix');
		return $this->fetchAll($select)->toArray();
	
	}
	
	public function SaveorUpdatePrefixData($data, $where)
	{
	    if($where != ''){
			$this->update($data, $where);
			return 'update';
		} else {
			$this->insert($data);
			$id=$this->getAdapter()->lastInsertId('main_prefix');
			return $id;
		}
		
	
	}
}