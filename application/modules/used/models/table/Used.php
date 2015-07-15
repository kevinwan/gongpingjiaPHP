<?php
/**
 * 二手车数据表
 * @author abiao 2015-7-15
 */
class Used_Model_Table_Used extends XF_Db_Table_Abstract
{
    public function __construct()
    {
        $this->_primary_key = 'used_id';
        $this->_table_name = 'used';
        $this->_db_name = XF_Db_Tool::getDBName('web');
    }
}
