<?php
/**
 * 车型相关数据操作
 * @author abiao 2015-7-17
 */
class Auto_Model_Type extends  Application_Model_Abstract
{
	public function __construct()
	{
		parent::__construct(new Auto_Model_Table_Type());
	}
        
        /**
	 *  根据车系获取车型列表
	 *  2015-7-17
	 */
	public function getsBySerialId($auto_serial_id)
        {
            $query = '/api/cars/category/detailmodels/gongpingjia-php/?model='.$auto_serial_id;
            $d_models = $this->pull($query);
            return $d_models->d_models;
        }
        
        /**
	 *  根据车型ID获取车型信息
	 *  2015-7-17
	 */
	public function getsByTypeId($auto_type_id)
        {
            $query = '/api/cars/category/params/gongpingjia-php/?d_model='.$auto_type_id;
            $data = $this->pull($query);
            return $data;
        }
        
}

