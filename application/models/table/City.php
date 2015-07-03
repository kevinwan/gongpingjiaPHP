<?php
/**
 * 地区数据模型
 * @author abiao 2015-7-2
 */
class Application_Model_Table_City extends XF_Db_Table_Abstract
{
	public function __construct()
	{
		$this->_primary_key = 'id';
		$this->_table_name = 'city';
		$this->_db_name = XF_Db_Tool::getDBName('web');
		
		//关联省份
		$this->_setFieldAssociated('province', 'parent', 'Application_Model_Table_City', 'id');
	}
}

