<?php
/**
 * 品牌数据表
 * @author abiao 2015-7-2
 */
class Auto_Model_Table_Brand extends XF_Db_Table_Abstract
{
    public function __construct()
    {
        $this->_primary_key = 'auto_brand_id';
        $this->_table_name = 'auto_brand';
        $this->_db_name = XF_Db_Tool::getDBName('web');
    }
}

