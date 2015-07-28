<?php
/**
 * 短信网关接口协议
 * @author abiao 2015-7-28
 */
class Application_Model_SmsSenderQXT implements Application_Model_SmsSenderInterface
{	
	private $_isOK = FALSE;
	private $_source_id = '2';
	private $_send_result = '';
	
	public function send($mobile, $message)
	{
		$this->_isOK = FALSE;
			
		$post_data = array(
			'user' => 'gpj_dev',   
			'pwd' => 'gpj_dev',
			'phone' => $mobile,
                        'serial' => time(),
			'msgcont' => iconv('utf-8', 'gbk', $message."【公平价】")
        );
        
		$postdata = http_build_query($post_data);   
  		$options = array(   
			'http' => array(   
				'method' => 'POST',   
				'header' => 'Content-type:application/x-www-form-urlencoded',   
				'content' => $postdata,   
				'timeout' => 15 * 60 // 超时时间（单位:s）   
			)   
		);   
  		$context = stream_context_create($options);   
 		$this->_send_result = file_get_contents('http://qd.qxt666.cn/interface/tomsg.jsp', false, $context); 
 		//$tmp = explode('|', $this->_send_result);
                $tmp = $this->_send_result;
 		//if (count($tmp) == 3 && $tmp[0] == 1 && $tmp[2] == $mobile)
                if($tmp === 0)
 		{
 			$this->_isOK = TRUE;
 		}
	}
	
	public function isOk()
	{
		return $this->_isOK;
	}
	
	public function getSourceId()
	{
		return $this->_source_id;
	}
	
	public function getMessage()
	{
		return $this->_source_id.':'.$this->_send_result;
	}
}



