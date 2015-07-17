<?php
/**
 * 估值报告控制器
 * 
 * @author abiao 2015-7-16
 */
class Report_IndexController extends XF_Controller_Abstract
{
    public function __construct()
    {
        parent::__construct($this);
    }
    
    public function indexAction()
    {
        
    }
    
    //我要卖估值报告
    public function sellReportAction()
    {
        $this->setLayout(new Layout_Default());
        $serialId = $this->getParam('serialId');
        $city_py= $this->getParam('city');
        $year= $this->getParam('year');
        $typeId= $this->getParam('typeId');
        $mileage= $this->getParam('mileage');
        
        if (!isset($serialId) || XF_Functions::isEmpty($serialId))
        {
            throw new XF_Exception('车系参数不正确');	
	}
        
        //获取车型列表
        $mod = new Auto_Model_Type();
        $types = $mod->getsBySerialId($serialId);
        //print_r($types);
        
        if ((!isset($serialId) || XF_Functions::isEmpty($typeId)) && !XF_Functions::isEmpty($types))
        {
            $typeId = $types[0][1][0]->id;
            $type = $mod->getsByTypeId($typeId);
	}
        else
        {
            $type = $mod->getsByTypeId($typeId);
        }
        print_r($type);
    }
}

