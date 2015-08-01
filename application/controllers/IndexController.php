<?php
class IndexController extends XF_Controller_Abstract
{
	public function __construct()
	{
            parent::__construct($this);
		try
		{
			$this->setCache(XF_Cache_Memcache::getInstance());
		}
		catch (XF_Exception $e)
		{}
		parent::__construct ( $this );
                $this->_view->setResourcePath($this->static_url);
	}
        
        protected function __cacheSign($action_name)
	{
		switch ($action_name)
		{
			case 'index':
				//是否存在跳转url
				if ($val = $this->getParam('redirect_url'))
				{
                                        //二手车随便看看
					if (strpos($val, '/used/index/index') !== false)
					{
						XF_Functions::go('/used/index/index');
					}
					//卖车估值页面
					elseif (preg_match_all("/\/sellreport\/(\d+)\/(.*?)\/(\d+)\/(\d+)\/(\d+)\//", $this->getParam('redirect_url'), $matchs))
					{
						XF_Functions::go('/sellreport/'.$matchs[1][0].'/');
					}
					//买车估值页面
					elseif (preg_match_all("/\/buyreport\/(\d+)\/(.*?)\/(\d+)\/(\d+)\/(\d+)\//", $this->getParam('redirect_url'), $matchs))
					{
						XF_Functions::go('/buyreport/'.$matchs[1][0].'/');
					}
					else
					{
						XF_Functions::go($val);
					}
					
				}
				if (is_object($this->nowCity))
				{
					return $this->nowCity->id.'_indexhome';
				}
				break;
		}
		
		return '';
	}
        
	public function indexAction()
	{
		$this->nowCity->id;
		// 设置布局、页面资源
		$this->setLayout ( new Layout_Default () );
		$this->_view->headTitle ( "爱车估价，就上公平价！{$this->nowCity->name}二手车在线评估_{$this->nowCity->name}二手车估价网" );
		$this->_view->headMeta ( "{$this->nowCity->name}二手车估价网，{$this->nowCity->name}二手车评估网，{$this->nowCity->name}二手车网，{$this->nowCity->name}二手车交易市场" );
		$this->_view->headMeta ("{$this->nowCity->name}公平价-国内首创免费二手车估值服务平台，每天收集分析{$this->nowCity->name}二手车交易的真实交易信息,为您提供：{$this->nowCity->name}二手车买车估价/卖车估价/价格评估/估价计算器等服务！");
		
		// 设置页面资源
		$this->_view->headStylesheet ( '/css/jquery.autocomplete.css' );
                $this->_view->headStylesheet ( '/css/index/index.css' );
		$this->_view->headScript ( '/js/jquery/jquery-migrate-1.2.1.min.js' )->appendFile ( '/js/jquery/jquery.autocomplete.min.js' )->appendFile ( '/js/pagejs/index.js' );
		/*
		 * $b = new Auto_Model_Brand ();
		 * $brands = $b->getBrand ();
		 * $first_letter = array ();
		 * foreach ( $brands as $brand )
		 * {
		 * if (isset ( $first_letter [$brand->first_letter] ['name'] ))
		 * {
		 * $first_letter [$brand->first_letter] ['brandNames'] [] = $brand->name;
		 * } else
		 * {
		 * $first_letter [$brand->first_letter] ['name'] = $brand->first_letter;
		 * $first_letter [$brand->first_letter] ['brandNames'] [] = $brand->name;
		 * }
		 * }
		 */
		// $this->_view->brands = $first_letter;
                $u = new Used_Model_Used ();
			$useds = $u->getIndexUsed ( $this->nowCity->id, 50 );
		
		// /////是否为AJAX请求
		if ($this->_request->isXmlHttpRequest ())
		{
			$num = $this->getParam ( 'num' );
			$u = new Used_Model_Used ();
			$useds = $u->getIndexUsed ( $this->nowCity->id, $num );
			$data = array ();
			$newImgUrlTemp = '';
			$newImgUrl = '';
			$newGrayImgUrl = '';
			foreach ( $useds as $k => $used )
			{
				$data [$k] ['title'] = $used->model_slug__name." ".$used->dmodel;
				$data [$k] ['modelSlugName'] = $used->model_slug__name;
				$newImgUrlTemp = str_replace ( 'gongpingjia.qiniudn.com', 'static.souchela.com/qiniudn', $used->thumbnail );
				$newImgUrl = $newImgUrlTemp . '?19812x';
				$newGrayImgUrl = $newImgUrlTemp . '?gray19812x';
				$data [$k] ['imgUrl'] = $newImgUrl;
				$data [$k] ['imgGrayUrl'] = $newGrayImgUrl;
				$data [$k] ['modelSlugId'] = $used->model_slug__id;
			}
			// print_r($data);
			// exit;
			die ( json_encode ( array (
					'status' => 'OK',
					'result' => $data
			) ) );
		}
		
		$this->_view->title = 'welcome to gongpingjia';
		$this->_view->my = 'abiao';
	}
}