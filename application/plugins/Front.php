<?php
/**
 * 前端控制器插件
 * 
 * @author abiao 2015-7-2
 */
class Application_Plugin_Front extends XF_Controller_Plugin_Abstract
{

	public function exception(XF_Controller_Request_Abstract $request, XF_Exception $e)
	{
		$this->_error($request, $e);
	}
	
	public function exception404(XF_Controller_Request_Abstract $request)
	{
		$this->_error($request, new XF_Controller_Exception('404 Not found!', 404));
	}
	
	private function _error(XF_Controller_Request_Abstract $request, XF_Exception $e)
	{
		XF_DataPool::getInstance()->add('ExceptionMessage', $e->getMessage());
		header('HTTP/1.1 404 Not Found');
		//如果是生产环境则显示友好的错误页面
		if(XF_Config::getInstance()->getEnvironmental() == 'production')
		{
			$request->setModule('Default')->setController('error')->setAction('index');
			XF_Controller_Front::getInstance()->dispatch($request, false);
		}
		else
		{
			throw $e;
		}
	}
	
	public function routeStartup(XF_Controller_Request_Abstract $request)
	{
		//导入重写规则
		$router = XF_Controller_Front::getInstance()->getRouter();
		//require APPLICATION_PATH.'/rewrites/front/default.php';

	}
	

	public function routeShutdown(XF_Controller_Request_Abstract $request)
	{
		//检测访问权限
		$m = $request->getModule();
		$c = $request->getController();
		if ($m == 'user' && $c != 'front')
		{
			$auth = new XF_Auth_Storage_Session();
			if ($auth->isEmpty())
			{
				XF_Functions::go('/login/?redirect_url='.urlencode($request->getRequestUrl()));
			}
		}
		
		//如果存在强制清除缓存命令
		$auth = new XF_Auth_Storage_Session();
		if ($auth->isEmpty() == false && $auth->read()->role_id != '0')
		{
			if ($request->getParam('clear') == 'cache')
			{
				XF_DataPool::getInstance()->add('clearCache', TRUE);
			}
			if ($request->getParam('clear') == 'action')
			{
				XF_DataPool::getInstance()->add('clearActionCache', TRUE);
			}
		}
	}
	
    public function postRender(&$html)
    {
    	$html = str_replace('$static', 'http://static.'.XF_Config::getInstance()->getDomain(), $html);
    	$html = str_replace('$cityReferer', 'false', $html);
    }
}

