<?php
/**
 * 短信息发送记录表
 * 
 * @author abiao 2015-7-28
 */
class Application_Model_Table_SmsSenderLog extends XF_Db_Table_Abstract
{
	public function __construct()
	{
		$this->_primary_key = 'id';
		$this->_table_name = 'sms_sender_log';
		$this->_db_name = XF_Db_Tool::getDBName('web');
		$this->_setFiledValidate();
	}
	
	private function _setFiledValidate()
	{
		$this->_field_validate_rule = new XF_Db_Table_ValidateRule(array(
			'rules' => array(
				'type' => 'required:true,in:code|reg|other',
				'mobile' => 'required:true,mobile:true',
				'source' => 'in:0|1|2'
			),
			'messages' => array(
				'mobile' => '手机号码不正确',
				'type' => '短信类型不正确',
				'source' => '短信发送平台不正确'
			)
		));
	}
}

