<?php
/**
 * 短信发送记录操作类
 * @author abiao 2015-07-28
 */
class Application_Model_SmsSenderLog extends Application_Model_Abstract
{	

	public function __construct()
	{
		parent::__construct(new Application_Model_Table_SmsSenderLog());
	}
	
	/**
	 * 添加记录
	 * @param string $mobile 手机号
	 * @param string $message 发送内容
	 * @param string $type 类型 code:验证码
	 * @param string $source 平台供应商 0:未知 1:畅天游 2:开路者(奇羽)vkpush 默认为0
	 */
	public static function add($mobile, $message, $type, $source = '0')
	{
		$tb = new Application_Model_Table_SmsSenderLog();
		$tb->fillDataFromArray(array(
			'mobile' => $mobile,
			'message' => $message,
			'type' => $type,
			'source' => $source,
			'ip' => XF_Controller_Request_Http::getInstance()->getClientIp(),
			'user_agent' => $_SERVER['HTTP_USER_AGENT'],
			'created' => date('Y-m-d H:i:s')
		));
		if (XF_DataPool::getInstance()->get('RequestFromApp') === true)
		{
			$tb->user_agent = 'cds_app';
		}
		return $tb->insert();
	}
	
	/**
	 * 更新发送供应商
	 * @param int $id 记录id
	 * @param int $source_id 供应商id
	 */
	public static function updateSource($id, $source_id)
	{
		$table = new Application_Model_Table_SmsSenderLog();
		return $table->getTableSelect()->setWhere(array('id' => $id))->update(array('source' => $source_id));
	}
	
	/**
	 * 更新为已发送成功
	 * @param int $id 记录id
	 */
	public static function updateComplete($id)
	{
		$table = new Application_Model_Table_SmsSenderLog();
		return $table->getTableSelect()->setWhere(array('id' => $id))->update(array('status' => '1'));
	}
	
	/**
	 * 更新发送反馈信息
	 * @param int $id 发送记录id
	 * @param string $message 反馈信息
	 * @return mixed
	 */
	public static function updateSendMessage($id, $message)
	{
		$table = new Application_Model_Table_SmsSenderLog();
		$row = $table->getTableSelect()->findRow($id);
		if ($row == false)
		{
			return true;
		}
		$row->send_message = $row->send_message."\n".$message;
		$row->update();
	}
	
	/**
	 * 根据手机号码获取最近发送的一条短信记录
	 * @param string $mobile 手机号码
	 * @return mixed
	 */
	public function getByMobile($mobile)
	{
		return $this->select()->setWhere(array('mobile' => $mobile))->setOrder('created DESC')->fetchRow();
	}
}

