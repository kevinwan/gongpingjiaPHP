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
		/*$b = new Auto_Model_Brand ();
		$brands = $b->getBrand ();
		$first_letter = array ();
		foreach ( $brands as $brand )
		{
			if (isset ( $first_letter [$brand->first_letter] ['name'] ))
			{
				$first_letter [$brand->first_letter] ['brandNames'] [] = $brand->name;
			} else
			{
				$first_letter [$brand->first_letter] ['name'] = $brand->first_letter;
				$first_letter [$brand->first_letter] ['brandNames'] [] = $brand->name;
			}
		}*/
                //$this->_view->brands = $first_letter;
                
            ///////是否为AJAX请求
            if ($this->_request->isXmlHttpRequest())
            {
                $num = $this->getParam('num');
                $u = new Used_Model_Used ();
                $useds = $u->getIndexUsed($this->nowCity->id,$num);
                $data = array();
                $newImgUrlTemp = '';
                $newImgUrl = '';
                $newGrayImgUrl = '';
                foreach ( $useds as $k=>$used )
		{
                    $data[$k]['title'] = $used->dmodel;
                    $newImgUrlTemp = str_replace('gongpingjia.qiniudn.com', 'static.souchela.com', $used->thumbnail); 
                    $newImgUrl = $newImgUrlTemp.'?19812x';
                    $newGrayImgUrl = $newImgUrlTemp.'?gray19812x';
                    $data[$k]['imgUrl'] = $newImgUrl;
                    $data[$k]['imgGrayUrl'] = $newGrayImgUrl;
                }
                //print_r($data);
                //exit;
                die(json_encode(array('status' => 'OK', 'result' => $data)));
            }
                
		$this->_view->title = 'welcome to gongpingjia';
                $this->_view->my = 'abiao';
	}
}