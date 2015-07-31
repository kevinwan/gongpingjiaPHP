<?php

/**
 * 估值报告控制器
 *
 * @author abiao 2015-7-16
 */
class Sell_IndexController extends XF_Controller_Abstract
{
	var $uploadPath;

	public function __construct()
	{
//		$this->uploadPath = "D:/xampp/htdocs/pahaoche/gongpingjia/static/uploads/car/";
		$this->uploadPath = "/wwwroot/gongpingjiaPHP/static/uploads/car/";
		parent::__construct($this);
		$this->_view->setResourcePath($this->static_url);
	}

	public function indexAction()
	{
	}

	// 添加个人信息
	public function personinfoAction()
	{
		$submit_statue = $this->getParam('statue');
		$infoId = $this->getParam('infoId');
		$dataFrom = $this->getParam('dataFrom');
		$comName = $this->getParam('comName');
		$gpj_session = new XF_Session("gpj_session");
		$session_ary = $gpj_session->read();

		if ((!isset ($infoId) || XF_Functions::isEmpty($infoId))) {
			throw new XF_Exception ('添加个人信息:数据内容不正确');
		}

		if ((isset ($submit_statue) && !XF_Functions::isEmpty($submit_statue))) {
			if ($submit_statue == "submit") {
				$userObj = new Sell_Model_User();
				$username = $this->getParam("username");
				$phone = $this->getParam("phone");
				$validate_code = $this->getParam("validate_code");
				$user = $userObj->findUserByPhone($phone);
				XF_View::getInstance()->assign('username', $username);
				XF_View::getInstance()->assign('phone', $phone);

				if(!$userObj->smsCodeIsOk($phone, $validate_code)) {
					$submit_statue = "errorCode";
				}else {
					if ($user) {
						$submit_statue = "ok";
						XF_View::getInstance()->assign('userId', $user->id);
						$session_ary["userId"] = $user->id;
					} else {
						$last_id = $userObj->addUser($username, $phone, $session_ary["dataFrom"], $infoId);
						if ($last_id) {
							$submit_statue = "ok";
							XF_View::getInstance()->assign('userId', $last_id);
							$session_ary["userId"] = $last_id;
						}
					}
					if($submit_statue == "ok") {
						$userObj->clearCode($phone, $validate_code);
					}
				}

				$session_ary["infoId"] = $infoId;
				$gpj_session->write($session_ary);
			}
		} else {
			$session_ary["dataFrom"] = $dataFrom;
			$gpj_session->write($session_ary);
			$submit_statue = "submit";
		}

		$this->setLayout(new Layout_Default ());
		$this->_view->headStylesheet('/css/sell/personinfo.css');
		$this->_view->headStylesheet('/css/common.css');
		$this->_view->headScript('/js/pagejs/personinfo.js');

		XF_View::getInstance()->assign('infoId', $infoId);
		XF_View::getInstance()->assign('statue', $submit_statue);
		$this->_view->detailModel = $session_ary["detail_model"];
		$this->_view->detailYear = $session_ary["detail_year"];
		$this->_view->detailMile = $session_ary["detail_mile"];
		$this->_view->detailPrice = $session_ary["detail_price"];
		$this->_view->comName = $comName;
	}

	//补充商品信息
	public function goodinfoAction()
	{
		$submit_statue = $this->getParam('statue');
		$gpj_session = new XF_Session("gpj_session");
		$session_ary = $gpj_session->read();

		if (!$gpj_session->hasContent("userId")) {
			throw new XF_Exception ('补充商品信息:用户没有登录');
		}

		if (isset ($submit_statue) && !XF_Functions::isEmpty($submit_statue)) {
			if ($submit_statue == "submit") {
				$car_parts = $this->getParam("car_parts");
				$car_color = $this->getParam("car_color");
				$period_insurance = $this->getParam("period_insurance");
				$car_maintain = $this->getParam("car_maintain");
				$max_cost = $this->getParam("max_cost");
				$transfer_num = $this->getParam("transfer_num");

				$sellObj = new Sell_Model_Sellinfo();
				$last_id = $sellObj->addSellInfo($session_ary["userId"], $session_ary["modelId"], $session_ary["changeId"], $session_ary["dataFrom"], $session_ary["infoId"], implode(",", $car_parts), $car_color, $period_insurance, $car_maintain, $max_cost, $transfer_num, $this->nowCity->id);
				if ($last_id) {
					$session_ary["sellInfoId"] = $last_id;
					$gpj_session->write($session_ary);
					XF_Functions::go("/sell/index/upload/");
				}
			}
		} else {
			$submit_statue = "submit";
		}

		$this->setLayout(new Layout_Default ());
		$this->_view->headStylesheet('/css/sell/goodinfo.css');
		$this->_view->headStylesheet('/css/common.css');
		$this->_view->headScript('/js/pagejs/goodinfo.js');
		XF_View::getInstance()->assign('statue', $submit_statue);
		$this->_view->detailModel = $session_ary["detail_model"];
		$this->_view->detailYear = $session_ary["detail_year"];
		$this->_view->detailMile = $session_ary["detail_mile"];
		$this->_view->detailPrice = $session_ary["detail_price"];
	}

	// 补充图片信息
	public function uploadAction()
	{
		$gpj_session = new XF_Session("gpj_session");
		$session_ary = $gpj_session->read();
		$this->setLayout(new Layout_Default ());
		$this->_view->headStylesheet('/css/sell/upload.css');
		$this->_view->headStylesheet('/css/common.css');
		$this->_view->headScript('/js/plupload/plupload.full.min.js')->appendFile('/js/pagejs/upload.js')->appendFile('/js/jquery/jquery-migrate-1.2.1.min.js');
		$this->_view->detailModel = $session_ary["detail_model"];
		$this->_view->detailYear = $session_ary["detail_year"];
		$this->_view->detailMile = $session_ary["detail_mile"];
		$this->_view->detailPrice = $session_ary["detail_price"];
		$this->_view->serialId = $session_ary["serialId"];
		$this->_view->modelId = $session_ary["modelId"];
	}

	public function uploadfileAction()
	{
		$gpj_session = new XF_Session("gpj_session");

		if (!$gpj_session->hasContent("userId")) {
			throw new XF_Exception ('上传商品图片:用户没有登录');
		}
		if (!$gpj_session->hasContent("sellInfoId")) {
			throw new XF_Exception ('上传商品图片:没有数据来源');
		}

		$attDes = $this->getParam('attdes');
		$attrType = $this->getParam('attrtype');

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		@set_time_limit(5 * 60);
		$timestamp = gmdate("Ymd");

		// usleep(5000);

		$targetDir = $this->uploadPath . $timestamp . "/";

		// $targetDir = 'uploads';
		$cleanupTargetDir = true;
		$maxFileAge = 5 * 3600;

		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}

		if (isset ($_REQUEST ["name"])) {
			$fileName = $_REQUEST ["name"];
		} elseif (!empty ($_FILES)) {
			$fileName = $_FILES ["file"] ["name"];
		} else {
			$fileName = uniqid("file_");
		}

		$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

		$chunk = isset ($_REQUEST ["chunk"]) ? intval($_REQUEST ["chunk"]) : 0;
		$chunks = isset ($_REQUEST ["chunks"]) ? intval($_REQUEST ["chunks"]) : 0;

		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die ('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}

				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}

		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die ('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		if (!empty ($_FILES)) {
			if ($_FILES ["file"] ["error"] || !is_uploaded_file($_FILES ["file"] ["tmp_name"])) {
				die ('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			if (!$in = @fopen($_FILES ["file"] ["tmp_name"], "rb")) {
				die ('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die ('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}

		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);

		if (!$chunks || $chunk == $chunks - 1) {
			rename("{$filePath}.part", $filePath);
		}

		$sessionAry = $gpj_session->read();
		$attrObj = new Sell_Model_Attr();
		$last_id = $attrObj->addAttr($sessionAry["userId"], $sessionAry["sellInfoId"], $attrType, "/" . $timestamp . "/" . $fileName, $attDes);

		die ('{"jsonrpc" : "2.0", "result" : "http://static.'.XF_Config::getInstance()->getDomain() . "/uploads/car/" . $timestamp . "/" . $fileName . '", "id" : "' . $last_id . '"}');
	}

	public function delImageAction()
	{
		$fileId = $this->getParam('fileId');
		$gpj_session = new XF_Session("gpj_session");
		$sessionAry = $gpj_session->read();
		$attrObj = new Sell_Model_Attr();
		$fileObj = $attrObj->selAttr($sessionAry["userId"], $fileId);
		if ($fileObj) {
			$filePath = $fileObj->attr_src;
			$last_id = $attrObj->delAttr($sessionAry["userId"], $fileId);
			if ($last_id) {
				unlink($this->$uploadPath . $filePath);
			}
		}
		die('{"code" : "200"}');
	}

	// 卖给商家
	public function merchantAction()
	{
		// 获得session，平台id
		$gpj_session = new XF_Session("gpj_session");

		if ($gpj_session->hasContent("modelId")) {
			$sessionAry = $gpj_session->read();
			$sessionAry["dataFrom"] = "merchant";
			$gpj_session->write($sessionAry);
		} else {
			throw new XF_Exception ('选择商家页面:评估页面没有选择车型');
		}

//        获取车商
		$used = new Used_Model_Used();
		$carAuctions = $used->getUsedCarDealers($sessionAry["province"], "auction", "", "1", "1000");
		$carDealers = $used->getUsedCarDealers($sessionAry["province"], "dealer", "", "1", "1000");
		$this->_view->dealers = array_merge($carAuctions, $carDealers);

		$this->setLayout(new Layout_Default ());
		$this->_view->headStylesheet('/css/sell/merchant.css');
		$this->_view->headStylesheet('/css/common.css');
		$this->_view->headScript('/js/pagejs/merchant.js');
		$this->_view->detailModel = $sessionAry["detail_model"];
		$this->_view->detailYear = $sessionAry["detail_year"];
		$this->_view->detailMile = $sessionAry["detail_mile"];
		$this->_view->detailPrice = $sessionAry["detail_price"];
		$this->_view->detailBrand = $sessionAry["detail_brand"];
	}

	// 卖给4s店
	public function fourshopAction()
	{
		$changeId = $this->getParam('changeId');

		// 获得session，平台id
		$gpj_session = new XF_Session("gpj_session");

		if ($gpj_session->hasContent("modelId")) {
			$sessionAry = $gpj_session->read();
			$sessionAry["dataFrom"] = "fourshop";
			$sessionAry["changeId"] = $changeId;
			$gpj_session->write($sessionAry);
		} else {
			throw new XF_Exception ('选择4s店页面:评估页面没有选择车型');
		}

		$model = new Auto_Model_Type();
		$car_model = $model->getsByTypeId($changeId);
		$this->_view->changeModel = $car_model->global_slug__name." ".$car_model->detail_model;

		//        获取4s
		$used = new Used_Model_Used();
		$carDealers = $used->getUsedCarDealers($sessionAry["province"], "4s", "", "1", "1000");
		$this->_view->fourshop = $carDealers;

		$this->setLayout(new Layout_Default ());
		$this->_view->headStylesheet('/css/sell/fourshop.css');
		$this->_view->headStylesheet('/css/common.css');
		$this->_view->headScript('/js/pagejs/fourshop.js');
		$this->_view->detailModel = $sessionAry["detail_model"];
		$this->_view->detailYear = $sessionAry["detail_year"];
		$this->_view->detailMile = $sessionAry["detail_mile"];
		$this->_view->detailPrice = $sessionAry["detail_price"];
		$this->_view->detailBrand = $sessionAry["detail_brand"];
	}

	// 卖给个人
	public function selfpersonAction()
	{
		// 获得session，平台id
		$gpj_session = new XF_Session("gpj_session");

		if ($gpj_session->hasContent("modelId")) {
			$sessionAry = $gpj_session->read();
			$sessionAry["dataFrom"] = "selfperson";
			$gpj_session->write($sessionAry);
		} else {
			throw new XF_Exception ('选择个人页面:评估页面没有选择车型');
		}

		//        获取车商
		$used = new Used_Model_Used();
		$carDealers = $used->getUsedCarDealers($sessionAry["province"], "c2c", "", "1", "1000");
		$this->_view->selfperson = $carDealers;

		$this->setLayout(new Layout_Default ());
		$this->_view->headStylesheet('/css/sell/selfperson.css');
		$this->_view->headStylesheet('/css/common.css');
		$this->_view->headScript('/js/pagejs/selfperson.js');
		$this->_view->detailModel = $sessionAry["detail_model"];
		$this->_view->detailYear = $sessionAry["detail_year"];
		$this->_view->detailMile = $sessionAry["detail_mile"];
		$this->_view->detailPrice = $sessionAry["detail_price"];
		$this->_view->detailBrand = $sessionAry["detail_brand"];
	}

	// 4s置换
	public function displaceAction()
	{
		$gpj_session = new XF_Session("gpj_session");
		$sessionAry = $gpj_session->read();
		//        获取4s
		$used = new Used_Model_Used();
		$carDealers = $used->getUsedCarDealers($sessionAry["province"], "4s", "", "1", "1000");
		$this->_view->fourshop = $carDealers;


		$this->setLayout(new Layout_Default ());
		$this->_view->headStylesheet('/css/common.css');
		$this->_view->headStylesheet('/css/displace/displace.css');
		$this->_view->headScript('/js/pagejs/displace.js')->appendFile("/js/jquery/jquery-migrate-1.2.1.min.js");
		$this->_view->detailModel = $sessionAry["detail_model"];
		$this->_view->detailYear = $sessionAry["detail_year"];
		$this->_view->detailMile = $sessionAry["detail_mile"];
		$this->_view->detailPrice = $sessionAry["detail_price"];
	}
}
