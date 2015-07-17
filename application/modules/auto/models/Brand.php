<?php
/**
 * 品牌相关数据操作
 * @author abiao 2015-7-2
 */
class Auto_Model_Brand extends  Application_Model_Abstract
{
	public function __construct()
	{
		parent::__construct(new Auto_Model_Table_Brand());
	}
        
        /**
	 *  获取品牌
	 *  2015-7-2
	 */
	public function getBrand()
        {
            $query = '/api/cars/category/brands/gongpingjia-php/';
            $brand = $this->pull($query);
            return $brand->brands;
        }
        
        /**
	 *  获取品牌关键词
	 *  2015-7-15
	 */
        public function getBrandKeywords()
        {
            $query = '/meta-data/model/';
            $data = $this->pull($query);
            return $data->data;
        }
}

