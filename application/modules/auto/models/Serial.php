<?php
/**
 * 车系相关数据操作
 * @author abiao 2015-7-17
 */
class Auto_Model_Serial extends  Application_Model_Abstract
{
	public function __construct()
	{
		parent::__construct(new Auto_Model_Table_Serial());
	}
        
        /**
	 *  根据品牌获取车系列表
	 *  2015-7-17
	 */
	public function getsByBrandId()
        {
            $query = '/api/cars/category/models/gongpingjia-php/?brand='.$auto_brand_id;
            $models = $this->pull($query);
            return $models->models;
        }
        
}


