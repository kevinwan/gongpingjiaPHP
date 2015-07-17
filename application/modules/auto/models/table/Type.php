<?php
/**
 * 车型数据表
 * @author abiao 2015-7-17
 */
class Auto_Model_Table_Type extends XF_Db_Table_Abstract
{
    public function __construct()
    {
        $this->_primary_key = 'auto_type_id';
        $this->_table_name = 'auto_type';
        $this->_db_name = XF_Db_Tool::getDBName('web');
    }
}

