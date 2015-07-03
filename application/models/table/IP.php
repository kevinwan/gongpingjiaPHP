<?php
/**
 * IP地址库
 * 
 * @author abiao 2015-7-2
 */
class Application_Model_Table_IP extends XF_Db_Table_Abstract
{
	public function __construct()
	{
		$this->_primary_key = 'id';
		$this->_table_name = 'ips';
		$this->_db_name = XF_Db_Tool::getDBName('web');
		
		$this->_setFieldAssociated('city', 'province_id,city_id', 'Application_Model_Table_City', 'id');
	}
}
