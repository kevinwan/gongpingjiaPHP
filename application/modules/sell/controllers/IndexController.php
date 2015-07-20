<?php
/**
 * 估值报告控制器
 *
 * @author abiao 2015-7-16
 */
class Sell_IndexController extends XF_Controller_Abstract
{
	public function __construct()
	{
		parent::__construct ( $this );
		$this->_view->setResourcePath ( $this->static_url );
	}
	
	public function indexAction()
	{
	}
	
	// 上传图片
	public function uploadAction()
	{
		$this->setLayout (new Layout_Default());
		$this->_view->headStylesheet ('/css/sell/upload.css');
		$this->_view->headStylesheet ('/css/common.css');
// 		$this->_view->headScript ( '/js/jquery/Validform_v5.3.2.js' )->appendFile ( '/js/date/WdatePicker.js' )->appendFile ( '/js/pagejs/sellreport.js' );
	}
	
	
}

