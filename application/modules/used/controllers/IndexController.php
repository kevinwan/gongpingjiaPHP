<?php

/**
 * 估值报告控制器
 *
 * @author abiao 2015-7-16
 */
class Used_IndexController extends XF_Controller_Abstract
{
    var $source_type;

    public function __construct()
    {
        // 车源类型
        $this->source_type = array(
            "dealer" => array(
                "bg" => "green-bg",
                "name" => "优质商家车源"
            ),
            "odealer" => array(
                "bg" => "violet-bg",
                "name" => "普通商家车源"
            ),
            "cpo" => array(
                "bg" => "orange-bg",
                "name" => "厂商认证二手车"
            ),
            "personal" => array(
                "bg" => "blue-bg",
                "name" => "个人车源"
            )
        );
        parent::__construct($this);
        $this->_view->setResourcePath($this->static_url);
    }

    public function indexAction()
    {
        $page = $this->getParam("page");
        $brandId = $this->getParam("brandId");
        $brandName = $this->getParam("brandName");
        $minAge = $this->getParam("minAge");
        $maxAge = $this->getParam("maxAge");
        $minMile = $this->getParam("minMile");
        $maxMile = $this->getParam("maxMile");
        $minPrice = $this->getParam("minPrice");
        $maxPrice = $this->getParam("maxPrice");
        $classify = $this->getParam("classify");
        $control = $this->getParam("control");
        $minVolume = $this->getParam("minvolume");
        $maxVolume = $this->getParam("maxvolume");
        $order_key = $this->getParam("order_key");

        if($minAge == 0) { $minAge = ""; }
        if($maxAge == 0) { $maxAge = ""; }
        if($minMile == 0) { $minMile = ""; }
        if($maxMile == 0) { $maxMile = ""; }
        if($minPrice == 0) { $minPrice = ""; }
        if($maxPrice == 0) { $maxPrice = ""; }
        if($minVolume == 0) { $minVolume = ""; }
        if($maxVolume == 0) { $maxVolume = ""; }
        if($order_key == "") { $order_key = "price"; }

        $searchCon = array(
            "brandId" => $brandId,
            "brandName" => $brandName,
            "minAge" => $minAge,
            "maxAge" => $maxAge,
            "minMile" => $minMile,
            "maxMile" => $maxMile,
            "minPrice" => $minPrice,
            "maxPrice" => $maxPrice,
            "classify" => $classify,
            "control" => $control,
            "minVolume" => $minVolume,
            "maxVolume" => $maxVolume,
	        'order_key' => $order_key
        );

        if (!isset($page) || XF_Functions::isEmpty($page) || !is_numeric($page) || $page<1) {
            $page = 1;
        }

        //设置布局、页面资源
        $this->setLayout(new Layout_Default());
		$this->_view->headTitle("{$this->nowCity->name}二手车价格查询-{$this->nowCity->name}二手车交易市场-{$this->nowCity->name}二手车报价网-公平价");
		$this->_view->headMeta("{$this->nowCity->name}二手车网，{$this->nowCity->name}二手车交易市场，{$this->nowCity->name}二手车报价，{$this->nowCity->name}二手车市场价格");
		$this->_view->headMeta("{$this->nowCity->name}公平价-为您提供真实的{$this->nowCity->name}二手车报价信息，{$this->nowCity->name}二手车市场价格,{$this->nowCity->name}二手车交易价格,{$this->nowCity->name}二手车交易等信息，方便您获得估值、选购、出售、{$this->nowCity->name}二手车的服务。");

        //设置页面资源
        $this->_view->headStylesheet('/css/used/used.css');
        $this->_view->headScript('/js/pagejs/used.js')->appendFile("/js/jquery/jquery-migrate-1.2.1.min.js");

        $used = new Used_Model_Used();
        $usedList = $used->getUsedList($this->nowCity->id, $page, 10, $searchCon);

        foreach($usedList->cars as $key => $val) {
            $val->mile = round($val->mile);
            if(!XF_Functions::isEmpty($val->year)) {
                $val->car_age = date("Y") - $val->year;
            }
            if(!XF_Functions::isEmpty($val->source_type)) {
                $val->source_val = $this->source_type[$val->source_type];
            }
            if(!XF_Functions::isEmpty($val->thumbnail)) {
                $val->thumbnail = $val->thumbnail."?imageView2/1/w/190/h/142";
            }else {
                // TODO: 没有图片的显示默认图片
            }
            $report = new Report_Model_Valuation();
            $valua = $report->getValuation($this->nowCity->id, $val->dmodel_id, $val->year, "", $val->mile, "buy");
            $val->deal_price = $valua->deal_price > 0 ? "公平价值".$valua->deal_price."万" : "暂无数据";
        }

        $this->_view->pageNo = $page;
        $this->_view->usedList = $usedList;
        $this->_view->totalNum = $usedList->count;
        $this->_view->totalPage = $usedList->pages;
        $this->_view->hasNext = $usedList->hax_next;
        $this->_view->hasPrevious = $usedList->has_previous;
        $this->_view->searchCon = $searchCon;
    }

    public function getUsedListAction()
    {
        if($this->_request->isPost() && $this->_request->isXmlHttpRequest()) {
            $page = $this->getParam("page");
	        $brandId = $this->getParam("brandId");
	        $brandName = $this->getParam("brandName");
	        $minAge = $this->getParam("minAge");
	        $maxAge = $this->getParam("maxAge");
	        $minMile = $this->getParam("minMile");
	        $maxMile = $this->getParam("maxMile");
	        $minPrice = $this->getParam("minPrice");
	        $maxPrice = $this->getParam("maxPrice");
	        $classify = $this->getParam("classify");
	        $control = $this->getParam("control");
	        $minVolume = $this->getParam("minvolume");
	        $maxVolume = $this->getParam("maxvolume");
	        $order_key = $this->getParam("order_key");

	        if($minAge == 0) { $minAge = ""; }
	        if($maxAge == 0) { $maxAge = ""; }
	        if($minMile == 0) { $minMile = ""; }
	        if($maxMile == 0) { $maxMile = ""; }
	        if($minPrice == 0) { $minPrice = ""; }
	        if($maxPrice == 0) { $maxPrice = ""; }
	        if($minVolume == 0) { $minVolume = ""; }
	        if($maxVolume == 0) { $maxVolume = ""; }
	        if($order_key == "") { $order_key = "price"; }

	        $searchCon = array(
		        "brandId" => $brandId,
		        "brandName" => $brandName,
		        "minAge" => $minAge,
		        "maxAge" => $maxAge,
		        "minMile" => $minMile,
		        "maxMile" => $maxMile,
		        "minPrice" => $minPrice,
		        "maxPrice" => $maxPrice,
		        "classify" => $classify,
		        "control" => $control,
		        "minVolume" => $minVolume,
		        "maxVolume" => $maxVolume,
		        'order_key' => $order_key
	        );

            if (!isset($page) || XF_Functions::isEmpty($page) || !is_numeric($page) || $page<2) {
                $page = 2;
            }

            $used = new Used_Model_Used();
            $usedList = $used->getUsedList($this->nowCity->id, $page, 10, $searchCon);

            foreach($usedList->cars as $key => $val) {
                $val->mile = round($val->mile);
                if(!XF_Functions::isEmpty($val->year)) {
                    $val->car_age = date("Y") - $val->year;
                }
                if(!XF_Functions::isEmpty($val->source_type)) {
                    $val->source_val = $this->source_type[$val->source_type];
                }
                if(!XF_Functions::isEmpty($val->thumbnail)) {
                    $val->thumbnail = $val->thumbnail."?imageView2/1/w/190/h/142";
                }else {

                }
            }

            $carJsons = json_encode($usedList->cars);
            die('{"code":"200", "cars":'.$carJsons.' }');
        }
    }

    public function getValuaModelAction() {
        if($this->_request->isPost() && $this->_request->isXmlHttpRequest()) {
            $report = new Report_Model_Valuation();
            $dmodelId = $this->getParam("dmodel_id");
            $year = $this->getParam("year");
            $mile = $this->getParam("mile");
            $usedId = $this->getParam("used_id");

            $valua = $report->getValuation($this->nowCity->id, $dmodelId, $year, "", $mile, "buy");
            die('{"code":"200","usedId":"'.$usedId.'","dealPrice":"'.$valua->deal_price.'"}');
        }
    }

}

