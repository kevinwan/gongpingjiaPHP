<?php
/**
 * 前端控制器，网站全局控制器
 * 
 * @author abiao 2015-7-2
 */
class Front_IndexController extends XF_Controller_Abstract
{
	public function __construct()
	{
		parent::__construct($this);
	}
        
        private function switchCity()
	{
		$isSpider = false;
		$spiders = array(
			'sogou spider',
			'Sosospider',
			'360Spider',
			'googlebot',
	        'mediapartners-google',
	        'baiduspider',
	        'msnbot',
	        'yodaobot',
	        'yahoo! slurp;',
	        'yahoo! slurp china;',
	        'iaskspider',
	        'sogou web spider',
	        'sogou push spider'
		);
		foreach ($spiders as $s)
		{
			if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), strtolower($s)) !== false)
			{
				$isSpider = true;
				break;
			}	
		}
		
		//如果来源是本站则不自动跳转
		if ((!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], XF_Config::getInstance()->getDomain()) == false) && $isSpider == false)
		{
			$domain_url = XF_Config::getInstance()->getDomain();
			
			//是否存在cookie
			$cookie = new XF_Cookie('local');
			if ($cookie->isEmpty() == false)
			{
				$mod = new Application_Model_City();
				$row = $mod->get($cookie->read());
				if ($row != false)
				{
					die('<script>window.location.href="http://'.$row->pinyin.'.'.$domain_url.'";</script>');
				}
			}
			
			/////IP
			$ip = XF_Controller_Request_Http::getInstance()->getClientIp();
			$mod = new Application_Model_IP();
			$row = $mod->getByIP($ip);
			$province_id = 1;
			//如果用户ip不存在则添加到库中
			if ($row == false)
			{
				$province_id = $mod->add($ip);
			}
			else 
			{
				$province_id = $row->province_id;
			}
			
			XF_Config::getInstance()->load('cityDomain');
			$cityDomains = (Array)XF_Config::getInstance()->cityDomain;
			
			foreach ($cityDomains as $domain => $val)
			{
				if ($val['id'] == $province_id)
				{
					die('<script>window.location.href="http://'.$domain.'.'.$domain_url.'";</script>');
				}
			}
			
			//默认为北京
			die('<script>window.location.href="http://beijing.'.$domain_url.'";</script>');
		}
	}
	
	public function indexAction()
	{
                $this->switchCity();
		$this->_view->title = 'welcome to gongpingjia';
	}
}
