<?php
/**
 * 全站统一消息(邮箱、短信)发送模板数据表
 * 
 * @author abiao 2015-7-28
 */
class Application_Model_Table_MailSmsEvent extends XF_Db_Table_Abstract
{
	public function __construct()
	{
		$this->_primary_key = 'event_id';
		$this->_table_name = 'mail_sms_event';
		$this->_db_name = XF_Db_Tool::getDBName('web');
	}
}
