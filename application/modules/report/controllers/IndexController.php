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
    }
}

