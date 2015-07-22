<?php
/**
 * 估值数据表
 * @author abiao 2015-7-17
 */
class Report_Model_Table_Vote extends XF_Db_Table_Abstract
{
    public function __construct()
    {
        $this->_primary_key = 'id';
        $this->_table_name = 'gpj_report_vote';
        $this->_db_name = XF_Db_Tool::getDBName('web');
    }
}

