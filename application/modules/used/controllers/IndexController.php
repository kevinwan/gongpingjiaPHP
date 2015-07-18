<?php
/**
 * 估值报告控制器
 *
 * @author abiao 2015-7-16
 */
class Used_IndexController extends XF_Controller_Abstract
{
	public function __construct()
	{
		parent::__construct($this);
				$this->_view->setResourcePath($this->static_url);
	}
	
	public function indexAction()
	{
		//设置布局、页面资源
		$this->setLayout(new Layout_Default());
		$this->_view->headTitle("【{$name}{$brand->show_name}报价_{$name}{$brand->show_name}汽车报价及图片】- 车多少网{$name}站");
		$this->_view->headMeta('name="keywords" content="'.$name.$brand->show_name.'报价,'.$name.$brand->show_name.'汽车报价,'.$name.$brand->show_name.'汽车报价及图片"');
		$this->_view->headMeta('name="description" content="车多少网(cheduoshao.com)'.$name.$brand->show_name.'报价频道提供海量'.$name.$brand->show_name.'汽车报价及图片信息,同时欢迎您来查询'.$name.$brand->show_name.'汽车比价信息,及定制'.$name.$brand->show_name.'汽车降价提醒服务."');
		
		//设置页面资源
		$this->_view->headStylesheet('/css/used/used.css');
		$this->_view->headScript('/js/pagejs/used.js');
		
	}
}

