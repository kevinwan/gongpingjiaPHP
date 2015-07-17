<?php
/**
 * 估值相关数据操作
 * @author abiao 2015-7-17
 */
class Report_Model_Valuation extends  Application_Model_Abstract
{
	public function __construct()
	{
		parent::__construct(new Report_Model_Table_Valuation());
	}
        
        /**
	 *  获取估值
	 *  2015-7-17
	 */
	public function getValuation($city,$d_model,$year,$month,$mile,$intent)
        {
            $query = '/api/cars/evaluation/gongpingjia-php/?d_model='.$d_model.'&year='.$year.'&month='.$month.'&mile='.$mile.'&city='.$city.'&intent='.$intent;
            $data = $this->pull($query);
            return $data;
        }
}

