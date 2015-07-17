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
        $this->_view->setResourcePath($this->static_url);
    }
    
    public function indexAction()
    {
        
    }
    
    //我要卖估值报告
    public function sellReportAction()
    {
        $serialId = $this->getParam('serialId');
        $city_py= $this->getParam('city');
        $year= $this->getParam('year');
        $typeId= $this->getParam('typeId');
        $mileage= $this->getParam('mileage');
        
        if (!isset($serialId) || XF_Functions::isEmpty($serialId))
        {
            throw new XF_Exception('车系参数不正确');	
	}
        
        //当前地区名称
	$name = $this->nowCity->name;
        $this->_view->serialId = $serialId;
        
        //获取车型列表
        $mod = new Auto_Model_Type();
        $types = $mod->getsBySerialId($serialId);
        //print_r($types);
        $this->_view->types = $types;
        
        if ((!isset($serialId) || XF_Functions::isEmpty($typeId)) && !XF_Functions::isEmpty($types))
        {
            $typeId = $types[0][1][0]->id;
            $type = $mod->getsByTypeId($typeId);
	}
        else
        {
            $type = $mod->getsByTypeId($typeId);
        }
        
        $this->_view->type = $type;
        
        //echo $this->nowCity->id.'_'.$type->id.'_'.($type->listed_year+2).'_'.$mileage.'_sell';
        $cityid = $this->nowCity->id;
        $d_model = $type->id;
        $year = $year > 0 ? $year : $type->listed_year+2;
        $month = '';
        $mile = floatval($mileage) > 0 ? floatval($mileage) : (date("Y")-$type->listed_year);
        $mile = 8;
        $intent = 'sell';
        $this->_view->mileage = $mile;
        //获取估值
        echo $cityid.'_'.$d_model.'_'.$year.'_'.$mile.'_'.$intent;
        $mod = new Report_Model_Valuation();
        $V = $mod->getValuation($cityid,$d_model,$year,'',$mile,$intent);
        $this->_view->V = $V;
        //print_r($V);
        $this->setLayout(new Layout_Default());
        // 设置页面资源
        $this->_view->headStylesheet ( '/css/report/report.css' );
        $this->_view->headStylesheet ( '/css/valid.css' );
	$this->_view->headScript ( '/js/jquery/Validform_v5.3.2.js' )->appendFile ( '/js/date/WdatePicker.js' )->appendFile ( '/js/pagejs/sellreport.js' );
    }
}

