<?php
class IndexController extends XF_Controller_Abstract
{
	public function __construct()
	{
		parent::__construct ( $this );
	}
	public function indexAction()
	{
		$this->nowCity->id;
		// 设置布局、页面资源
		$this->setLayout ( new Layout_Default () );
		$this->_view->headTitle ( "【{$name}{$brand->show_name}报价_{$name}{$brand->show_name}汽车报价及图片】- 车多少网{$name}站" );
		$this->_view->headMeta ( 'name="keywords" content="' . $name . $brand->show_name . '报价,' . $name . $brand->show_name . '汽车报价,' . $name . $brand->show_name . '汽车报价及图片"' );
		$this->_view->headMeta ( 'name="description" content="车多少网(cheduoshao.com)' . $name . $brand->show_name . '报价频道提供海量' . $name . $brand->show_name . '汽车报价及图片信息,同时欢迎您来查询' . $name . $brand->show_name . '汽车比价信息,及定制' . $name . $brand->show_name . '汽车降价提醒服务."' );
		
		// 设置页面资源
		$this->_view->headStylesheet ( '/css/cds_newcar141030.css' );
		$this->_view->headScript ( '/js/jquery.wheel.js' )->appendFile ( '/js/jquery.cookie.js' )->appendFile ( '/js/page/newcars141030.js' );
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
				$data [$k] ['title'] = $used->dmodel;
				$newImgUrlTemp = str_replace ( 'gongpingjia.qiniudn.com', 'static.souchela.com/qiniudn', $used->thumbnail );
				$newImgUrl = $newImgUrlTemp . '?19812x';
				$newGrayImgUrl = $newImgUrlTemp . '?gray19812x';
				$data [$k] ['imgUrl'] = $newImgUrl;
				$data [$k] ['imgGrayUrl'] = $newGrayImgUrl;
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