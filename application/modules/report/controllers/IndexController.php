<?php
/**
 * 估值报告控制器
 *
 * @author abiao 2015-7-16
 */
class Report_IndexController extends XF_Controller_Abstract
{
	public function __construct()
	{
		parent::__construct ( $this );
		$this->_view->setResourcePath ( $this->static_url );
	}
	public function indexAction()
	{
	}

	// 我要卖估值报告
	public function sellReportAction()
	{
		$serialId = $this->getParam ( 'serialId' );
		$city_py = $this->getParam ( 'city' );
		$year = $this->getParam ( 'year' );
		$typeId = $this->getParam ( 'typeId' );
		$mileage = $this->getParam ( 'mileage' );

		if (! isset ( $serialId ) || XF_Functions::isEmpty ( $serialId ))
		{
			throw new XF_Exception ( '车系参数不正确' );
		}

		// 当前地区名称
		$name = $this->nowCity->name;
		$this->_view->serialId = $serialId;

		// 获取车型列表
		$mod = new Auto_Model_Type ();
		$types = $mod->getsBySerialId ( $serialId );
		// print_r($types);
		$this->_view->types = $types;

		if ((! isset ( $serialId ) || XF_Functions::isEmpty ( $typeId )) && ! XF_Functions::isEmpty ( $types ))
		{
			$typeId = $types [0] [1] [0]->id;
			$type = $mod->getsByTypeId ( $typeId );
		} else
		{
			$type = $mod->getsByTypeId ( $typeId );
		}

//        获得session,存车型id
        $gpj_session = new XF_Session("gpj_session");
        $sessionAry = array();
        $sessionAry["modelId"] = $typeId;
        $gpj_session->write($sessionAry);

		$this->_view->type = $type;

//        获取评估报告投票
        $vote = new Report_Model_Vote();
        $reportVote = $vote->getVoteByTypeId($typeId);

        if($reportVote) {
            $this->_view->goodNum = $reportVote->right_vote;
            $this->_view->noGoodNum = $reportVote->noright_vote;
            $this->_view->totalNum = $reportVote->right_vote+$reportVote->noright_vote;
        }else {
            $this->_view->goodNum = 0;
            $this->_view->noGoodNum = 0;
            $this->_view->totalNum = 0;
        }

        // echo $this->nowCity->id.'_'.$type->id.'_'.($type->listed_year+2).'_'.$mileage.'_sell';
		$cityid = $this->nowCity->id;
		$d_model = $type->id;
		$year = $year > 0 ? $year : $type->listed_year + 2;
		$month = '';
		$mile = floatval ( $mileage ) > 0 ? floatval ( $mileage ) : (date ( "Y" ) - $type->listed_year);
		$mile = 8;
		$intent = 'sell';
		$this->_view->mileage = $mile;
		// 获取估值
		//echo $cityid . '_' . $d_model . '_' . $year . '_' . $mile . '_' . $intent;
		$mod = new Report_Model_Valuation ();
		$V = $mod->getValuation ( $cityid, $d_model, $year, '', $mile, $intent );
		$this->_view->V = $V;
		// print_r($V);
		$this->setLayout ( new Layout_Default () );
		// 设置页面资源
		$this->_view->headStylesheet ( '/css/report/report.css' );
		$this->_view->headStylesheet ( '/css/valid.css' );
		$this->_view->headScript ( '/js/jquery/Validform_v5.3.2.js' )->appendFile ( '/js/date/WdatePicker.js' )->appendFile ( '/js/pagejs/sellreport.js' );
	}

	// 我要买估值报告
	public function buyReportAction()
    {
        $serialId = $this->getParam ( 'serialId' );
        $city_py = $this->getParam ( 'city' );
        $year = $this->getParam ( 'year' );
        $typeId = $this->getParam ( 'typeId' );
        $mileage = $this->getParam ( 'mileage' );

        if (! isset ( $serialId ) || XF_Functions::isEmpty ( $serialId ))
        {
            throw new XF_Exception ( '车系参数不正确' );
        }

        // 当前地区名称
        $name = $this->nowCity->name;
        $this->_view->serialId = $serialId;

        // 获取车型列表
        $mod = new Auto_Model_Type ();
        $types = $mod->getsBySerialId ( $serialId );
        // print_r($types);
        $this->_view->types = $types;

        if ((! isset ( $serialId ) || XF_Functions::isEmpty ( $typeId )) && ! XF_Functions::isEmpty ( $types ))
        {
            $typeId = $types [0] [1] [0]->id;
            $type = $mod->getsByTypeId ( $typeId );
        } else
        {
            $type = $mod->getsByTypeId ( $typeId );
        }

//        获得session,存车型id
        $gpj_session = new XF_Session("gpj_session");
        $sessionAry = array();
        $sessionAry["modelId"] = $typeId;
        $gpj_session->write($sessionAry);

        $this->_view->type = $type;

//        获取评估报告投票
        $vote = new Report_Model_Vote();
        $reportVote = $vote->getVoteByTypeId($typeId);

        if($reportVote) {
            $this->_view->goodNum = $reportVote->right_vote;
            $this->_view->noGoodNum = $reportVote->noright_vote;
            $this->_view->totalNum = $reportVote->right_vote+$reportVote->noright_vote;
        }else {
            $this->_view->goodNum = 0;
            $this->_view->noGoodNum = 0;
            $this->_view->totalNum = 0;
        }

        // echo $this->nowCity->id.'_'.$type->id.'_'.($type->listed_year+2).'_'.$mileage.'_sell';
        $cityid = $this->nowCity->id;
        $d_model = $type->id;
        $year = $year > 0 ? $year : $type->listed_year + 2;
        $month = '';
        $mile = floatval ( $mileage ) > 0 ? floatval ( $mileage ) : (date ( "Y" ) - $type->listed_year);
        $mile = 8;
        $intent = 'buy';
        $this->_view->mileage = $mile;
        // 获取估值
        //echo $cityid . '_' . $d_model . '_' . $year . '_' . $mile . '_' . $intent;
        $mod = new Report_Model_Valuation ();
        $V = $mod->getValuation ( $cityid, $d_model, $year, '', $mile, $intent );
        $this->_view->V = $V;
        // print_r($V);
        $this->setLayout ( new Layout_Default () );
        // 设置页面资源
        $this->_view->headStylesheet ( '/css/report/report.css' );
        $this->_view->headStylesheet ( '/css/valid.css' );
        $this->_view->headScript ( '/js/jquery/Validform_v5.3.2.js' )->appendFile ( '/js/date/WdatePicker.js' )->appendFile ( '/js/pagejs/buyreport.js' );
    }

    // 评估结果投票
    public function voteReportAction() {
        if ($this->_request->isXmlHttpRequest () && $this->_request->isPost()) {
            $typeId = $this->getParam ("typeId");
            $voteType = $this->getParam("voteType");

            $gpjSession = new XF_Session("gpj_vote");

            if (!$gpjSession->isEmpty()) {
                if(in_array($typeId, $gpjSession->read())) {
                    die ('{"code": "101"}');
                }
            }

            $cookie = new XF_Cookie("gpj_vote");
            $cookieAry = array();

            if (!$cookie->isEmpty()) {
                $cookieAry = explode(",", $cookie->read());
                if(in_array($typeId, $cookieAry)) {
                    die ('{"code": "101"}');
                }
            }

            $vote = new Report_Model_Vote();
            $reportVote = $vote->getVoteByTypeId($typeId);

            if($reportVote) {
                if($voteType == "right") {
                    $voteAry["right_vote"] = $reportVote->right_vote + 1;
                }elseif($voteType == "noright") {
                    $voteAry["noright_vote"] = $reportVote->noright_vote + 1;
                }
                $res = $vote->upVoteById($reportVote->id, $voteAry);
            }else {
                if($voteType == "right") {
                    $voteAry["right_vote"] = 1;
                    $voteAry["noright_vote"] = 0;
                }elseif($voteType == "noright") {
                    $voteAry["right_vote"] = 0;
                    $voteAry["noright_vote"] = 1;
                }
                $voteAry["car_id"] = $typeId;
                $res = $vote->addVote($voteAry);
            }

            if($res) {
                $cookieAry[] = $typeId;
                $cookie->write(implode(",", $cookieAry), 86400);
                if (!$gpjSession->isEmpty()) {
                    $gpjAry = $gpjSession->read();
                    $gpjAry[] = $typeId;
                }
                $gpjSession->write($gpjAry);
                die('{"code":"200"}');
            }

        }
    }

}

