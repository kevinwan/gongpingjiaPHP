<?php
/**
 * 默认网站布局
 * @author abiao 2015-7-16
 *
 */
class Layout_Default extends XF_View_Layout_Abstract
{
	private $nowCity;
	
	public function __construct()
	{
	$this->_tpl = 'default.php';
	}

	protected function _init() {
		$this->nowCity = $this->getView()->nowCity;
	$this->assign('domain', XF_Config::getInstance()->getDomain());
	$this->assign('nowCity', $this->nowCity);
		
	$a = $this->getRequest()->getAction();
	$c = $this->getRequest()->getController();
	$m = $this->getRequest()->getModule();
	}

}

