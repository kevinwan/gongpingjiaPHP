<?php
/**
 * 通用API
 * 
 * @author abiao 2015-7-28
 */
class Api_CommonController extends Api_AbstractController
{
	public function __construct()
	{
		parent::__construct($this);
	}
	
	/**
	 * 获取省份列表
	 */
	public function provinceAction()
	{
		
		if($this->getParam('provinceList'))
		{
			$province_ids = explode(',', $this->getParam('provinceList'));
			$mod = new Application_Model_City();
			$rows = $mod->select()->setWhereIn('city_id', $province_ids)->setLimit(false)->fetchAll();
			
		}else{
			$mod = new Application_Model_City();
			$rows = $mod->getsByProvince();
		}
		

		$tmp = '';
		if ($rows != false)
		{
			foreach ($rows as $row)
			{
				$tmp[] = array(
					'id' => $row->city_id,
					'name' => $row->name,
					'first_letter' => $row->first_letter,
					'py' => $row->pinyin
				);
			}
		}
		$this->responseOK($tmp);
	}
	
	/**
	 * 获取城市列表
	 * @param int $pid 省份id
	 */
	public function cityAction()
	{
		if ($pid = $this->getParamNumber('pid'))
		{
			if (in_array($pid, array(1, 20, 76, 96)))
			{
				$this->responseOK();
			}
			$tmp = '';
			$mod = new Application_Model_City();
			$rows = $mod->getsByCity($pid);
			if ($rows != false)
			{
				foreach ($rows as $row)
				{
					$tmp[] = array(
						'id' => $row->city_id,
						'name' => $row->name,
						'py' => $row->pinyin
					);
				}
			}
			$this->responseOK($tmp);	
		}
		$this->responseArgumentMessageError();
	}
	
	/**
	 * 发送手机验证码
	 * @param string $mobile 手机号码
	 */
	public function sendSmsCodeAction()
	{
		$mobile = $this->getParameter('mobile');
		if ($mobile == NULL)
		{
			$this->responseMissArgumentMessageError();
		}
		//图形验证码是否正确
		/*$sess = new XF_Session('XF_ImageVerify');
		if ($sess->read() != strtolower($this->getParameter('imgCode')))
		{
			$this->responseError('图形验证码不正确');
		}*/
		if ($this->getParam('jsonp') && $this->getParam('_'))
		{
			$smsCode = (string)mt_rand(123456, 911638);
			$mod = new Application_Model_MailSmsEvent();
			try
			{
				$status = $mod->sendSmsCode($mobile, $smsCode);
				if ($status === TRUE)
				{
					$this->responseOK();
				}
				else
				{
					$this->responseError('验证码发送失败，请稍后再试');
				}
			}
			catch (XF_Exception $e)
			{
				$this->responseError($e->getMessage());
			}
		}
		$this->responseError('请求错误');
	}
	
	/**
	 * 检测验证码是否正确
	 * @param string $mobile 手机号码
	 * @param int $smsCode 验证码
	 */
	public function checkSmsCodeAction()
	{
		$mod = new User_Model_Front();
		if ($mod->smsCodeIsOk($this->getParameter('mobile'), $this->getParameter('smsCode')))
		{
			$this->responseOK();
		}
		$this->responseError('验证码不正确');
	}
	
	/**
	 * 检测图片验证码是否正确
	 * @param int $imgCode 验证码
	 */
	public function checkImgCodeAction()
	{
		$sess = new XF_Session('XF_ImageVerify');
		if ($sess->read() != strtolower($this->getParameter('imgCode')))
		{
			$this->responseError('图形验证码不正确');
		}
		$this->responseOK();
	}
}
