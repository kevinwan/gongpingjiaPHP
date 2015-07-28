<?php
/**
 * 短信息发送通用接口
 * @author abiao 2015-07-28
 */
interface Application_Model_SmsSenderInterface
{	
	
	/**
	 * 发送
	 * @param int $mobile 手机号码
	 * @param string $message 短信内容
	 * @return void
	 */
	public function send($mobile, $message);
	
	/**
	 * 获取供应商在内部的id
	 * @return int
	 */
	public function getSourceId();
	
	/**
	 * 是否发送成功
	 * @return bool
	 */
	public function isOk();
	
	/**
	 * 获取发送反馈信息
	 * @return string
	 */
	public function getMessage();
}

