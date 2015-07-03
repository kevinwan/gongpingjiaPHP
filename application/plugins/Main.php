<?php
/**
 * 应用程序插件
 * @author abiao 2015-7-2
 *
 */
class Application_Plugin_Main extends XF_Controller_Plugin_Abstract
{
    public function exception(XF_Controller_Request_Abstract $request, XF_Exception $e)
    {
        $this->_error($request, $e);
    }
	
    public function exception404(XF_Controller_Request_Abstract $request)
    {
        $this->_error($request, new XF_Exception('404 Not found!', 404));
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
        //require APPLICATION_PATH.'/rewrites/main/default.php';
    }
	
    public function routeShutdown(XF_Controller_Request_Abstract $request)
    {
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
	//自动清除缓存
	if ($request->getParam('autoclear') == 'true')
	{
            XF_DataPool::getInstance()->add('clearActionCache', TRUE);
	}
		
	//获取用户当前真实的地区id
	$data = array(
		'id' => '1',
		'name' => '北京',
		'pinyin' => 'beijing',
	);
	$ip = new Application_Model_IP();
	$ip->table()->setAssociatedAuto('city');
	$row = $ip->getByIP($request->getClientIp());
	if ($row != false) 
	{
            $data = array(
                'id' => $row->province_id,
		'name' => $row->city_province_id->name,
		'pinyin' => $row->city_province_id->pinyin,
            );
	}
	XF_View::getInstance()->assign('trueCity', (object)$data);
    }
	
    public function postRender(&$html)
    {
        $static_url = 'http://static.'.XF_Config::getInstance()->getDomain();
    	
    	$html = str_replace('$static', $static_url, $html);
    	$html = str_replace('src="/upload', 'src="'.$static_url.'/upload', $html);
    	$html = str_replace('src="/images', 'src="'.$static_url.'/img', $html);
    	
    	//来源页面是地区切换页
    	if($_SERVER['HTTP_REFERER'] =='http://www.'.XF_Config::getInstance()->getDomain().'/')
    	{
    		$html = str_replace('$cityReferer', 'true', $html);
    	}
    	else
    	{
    		$html = str_replace('$cityReferer', 'false', $html);
    	}
    	
    }
}

