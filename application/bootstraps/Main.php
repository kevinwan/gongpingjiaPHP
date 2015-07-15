<?php
/**
 * 应用程序引导类
 * @author abiao 2015-7-1
 *
 */
class MainBootstrap extends XF_Application_Bootstrap
{
    /**
     * Config
     * @var XF_Config
     */
    private $_config;
    
    /**
     * 地区二级域名列表
     * @var array
     */
    private $_cityDomains;
    
    /**
     * 前端控制器
     * @var XF_Controller_Front
     */
    private $_front;
    
    /** 
    * 当前地区二级域名资料
    * @var array | null
    */
    private $_nowCityDomain = NULL;
    
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
    * 关闭已绑定域名的模块
    */
    protected function initCloseModule()
    {
        $this->_front->getRouter()
                ->closeModule('api')
                ->closeModule('front');
    }
    
    /**
    * 注册插件
    */
    protected function initPlugin()
    {
        $this->_front->registerPlugin(new Application_Plugin_Main());
    }
    
    /**
    * 加载自定义的配置文件
    */
    protected function initConfig()
    {
	$this->_config->load('cityDomain');
	$this->_cityDomains = $this->_config->cityDomain;
    }
    
    /**
    * 检测二级域名
    */
    protected function initCheckDomain()
    {
	$cookie = new XF_Cookie('local');
	$tmp = explode('.', $_SERVER['HTTP_HOST']);
	//是否为地区二级域名
	if (isset($this->_cityDomains->{$tmp[0]}))
	{
            $this->_nowCityDomain = (object)$this->_cityDomains->{$tmp[0]};
            $this->_nowCityDomain->pinyin = $tmp[0];
            //记录当前浏览的地区id
            $cookie->write($this->_nowCityDomain->id, 604800, '/', '.'.$this->_config->getDomain());
	}
	//如果是未知的二级域名，直接跳到当前地区首页
	else
	{
            //记录当前浏览的地区id
            $cookie->write(1, 604800, '/', '.'.$this->_config->getDomain());
            XF_Functions::go('http://beijing.'.$this->_config->getDomain());
	}
    }
    
    /**
    * 添加相关资料到控制器中，方便Action中直接读取
    */
    protected function initAddDataToController()
    { 
        if ($this->_nowCityDomain != NULL)
        {
            XF_Controller_Front::getInstance()->addHandleData('nowCity', $this->_nowCityDomain);
            XF_View::getInstance()->assign('nowCity', $this->_nowCityDomain);
            XF_DataPool::getInstance()->add('nowCity', $this->_nowCityDomain);
	}		
        //添加静态资源URL
	XF_Controller_Front::getInstance()->addHandleData('static_url', 'http://static.'.XF_Config::getInstance()->getDomain());
    }
    
    /**
    * 向View中添加相关的资料
    */
    protected function initAddDataToView()
    {
	//当前配置文件中的主域名
	XF_View::getInstance()->assign('domain', $this->_config->getDomain());
    }
    
    
    /**
    * 导入自定义的函数库
    */
    protected function initImportFunctions()
    {

    }
    
}
