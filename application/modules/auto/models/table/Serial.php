<?php
/**
 * 车系数据表
 * @author abiao 2015-7-17
 */
class Auto_Model_Table_Serial extends XF_Db_Table_Abstract
{
    public function __construct()
    {
        $this->_primary_key = 'auto_serial_id';
        $this->_table_name = 'auto_serial';
        $this->_db_name = XF_Db_Tool::getDBName('web');
    }
}

