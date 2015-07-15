<?php
/**
 * 应用程序引导类
 * @author abiao 2015-7-2
 *
 */
class FrontBootstrap extends XF_Application_Bootstrap
{
    /**
     * Config
     * @var XF_Config
     */
    private $_config;
	
    /**
     * 前端控制器
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
     * 绑定模块
     */
    protected function initBindModule()
    {
    	$this->_front->getRouter()
                ->bindDomain('front', 'www.'.$this->_config->getDomain())
    		->bindDomain('front', $this->_config->getDomain());
    }
	
    /**
     * 加载配置文件
     */
    protected function initConfigFile()
    {
        $this->_config->load('common');	
    }
	
    /**
     * 注册插件
     */
    protected function initPlugin()
    {
	$this->_front->registerPlugin(new Application_Plugin_Front());
    }

    /**
     * 添加相关资料到控制器中，方便Action中直接读取
     */
    protected function initAddDataToController()
    { 
	//设置当前或之前访问的地区资料
	$cookie = new XF_Cookie('local');
	$province_id = $cookie->read();
	$mod = new Application_Model_City();
	$row = $mod->get($province_id);
	if ($row != false && $row->parent == '0')
	{
            $obj = (object)array('id' => $province_id, 'name' => $row->name, 'pinyin' => $row->pinyin);
            XF_Controller_Front::getInstance()->addHandleData('nowCity', $obj);
            XF_View::getInstance()->assign('nowCity', $obj);
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

