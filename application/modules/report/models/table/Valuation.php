<?php
/**
 * 估值数据表
 * @author abiao 2015-7-17
 */
class Auto_Model_Table_Valuation extends XF_Db_Table_Abstract
{
    public function __construct()
    {
        $this->_primary_key = 'valuation_id';
        $this->_table_name = 'valuation';
        $this->_db_name = XF_Db_Tool::getDBName('web');
    }
}

