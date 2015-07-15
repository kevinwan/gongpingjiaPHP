<?php
//一般普通错误
define('API_ERR_CODE', 500);
//未登录
define('API_ERR_CODE_LOGIN', 1000);
/**
 * API控制器通用基础抽象类，所有的API控制器都应该继承此类
 * @author abiao 2015-7-15
 */
abstract class Api_AbstractController extends XF_Controller_Easy
{
	protected $_auth;
	
	public function __construct($controller)
	{
		parent::__construct($controller);
		
		//获取用户登录信息
		$auth = new XF_Auth_Storage_Session();
		if ($auth->isEmpty() == FALSE)
		{
			$this->_auth = $auth->read();
		}
	}
	
	/**
	 * 检测登录状态【如果没有登录将直接返回提示信息】
	 * @return void
	 */
	protected function checkLoginStatus()
	{
		if ($this->_auth == null)
		{
			$this->responseError('请先登录，再尝试该操作！', API_ERR_CODE_LOGIN);
		}
	}
	
	/**
	 * 验证指定的验证码是否有效
	 * @param string $smsCode 手机验证码
	 * @return bool
	 */
	public function smsCodeIsOk($mobile, $smsCode)
	{
		try 
		{
			$mem = XF_Cache_Memcache::getInstance();
		}
		catch (XF_Exception $e)
		{
			return false;
		}

		$code = $mem->read($mobile.'_'.$smsCode);
		return $code == $smsCode;
	}
	
	/**
	 * 获取参数，如果为NULL将直接输出错误信息
	 * @param string $key 参数名
	 * @param mixed $default 默认值，默认为NULL
	 * @return string
	 */
	protected function getParameter($key , $default = NULL)
	{
		$val = $this->getParam($key, $default);
		if ($val === NULL)
		{
			$this->responseError('缺少参数：'.$key);
		}
		return $val;
	}
	
	/**
	 * 响应错误
	 * @return void
	 */
	protected function responseError($message, $code = API_ERR_CODE)
	{
		$this->_response(array('status' => 'ERROR', 'code' => $code, 'message' => $message));
	}
	
	/**
	 * 响应错误，提示缺少参数
	 * @return void
	 */
	protected function responseMissArgumentMessageError()
	{
		$this->_response(array('status' => 'ERROR', 'code' => API_ERR_CODE, 'message' => '缺少参数'));
	}
	
	/**
	 * 响应错误，提示参数不正确
	 * @return void
	 */
	protected function responseArgumentMessageError()
	{
		$this->_response(array('status' => 'ERROR', 'code' => API_ERR_CODE, 'message' => '参数不正确'));
	}
	
	/**
	 * 响应成功
	 * @param Array $data 结果数组
	 */
	protected function responseOK($data = '')
	{
		$this->_response(array('status' => 'OK', 'result' => $data));
	}
	
	/**
	 * 响应结果
	 * @param array $data
	 */
	private function _response(Array $data)
	{
		header("Content-type:text/plain;charset=UTF-8");
		$cb = $this->getParam('jsonp', NULL);
		if ($cb !== NULL) 
			die($cb.'('.json_encode($data).')');
		die(json_encode($data));
	}
}

