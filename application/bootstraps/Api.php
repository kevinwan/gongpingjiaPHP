<?php
/**
 * API应用程序引导类
 * @author abiao 2015-7-15
 *
 */
class ApiBootstrap extends XF_Application_Bootstrap
{
	/**
	 * Config
	 * @var XF_Config
	 */
	private $_config;
	
	/**
	 * @var XF_Controller_Front
	 */
	private $_front;
	
	public function __construct()
	{
		$this->_config = XF_Config::getInstance();
		$this->_front = XF_Controller_Front::getInstance()->init();
	}

	protected function runStartup()
	{
		ini_set('session.cookie_domain', '.'.$this->_config->getDomain());
	}
	
	/**
	 * 绑定当前域名到api模块
	 */
	protected function initBindModule()
	{
		$this->_front->getRouter()->bindDomain('api', 'webapi.'.$this->_config->getDomain());
	}
	
	/**
	 * 注册插件
	 */
	protected function initPlugin()
	{
		//$this->_front->registerPlugin(new Application_Plugin_Api());
	}

    /**
	 * 导入自定义的函数库
	 */
	protected function initImportFunctions()
	{		

	}


}


