<?php
/**
 * 全站统一消息(邮箱、短信)发送操作类
 * @author abiao 2015-7-28
 */
class Application_Model_MailSmsEvent extends Application_Model_Abstract
{	
	/**
	 * 短信息发送供应商
	 * @var Application_Model_SmsSenderInterface
	 */
	private $_sender;
	
	public function __construct(Application_Model_SmsSenderInterface $sender = NULL)
	{
		parent::__construct(new Application_Model_Table_MailSmsEvent());
		$this->_sender = $sender;
	}
	
	/**
	 * 用户：注册成功(手机方式)
	 * @param int $user_id 用户id
	 * @param string $passwd 用户注册的密码【明码】，如果不能空，将认为是系统自动注册的账号，同时发送密码
	 */
	public function sendByMobileRegisteredSuccess($user_id, $passwd = NULL)
	{
		$mod = new User_Model_User();
		$user = $mod->get($user_id);
		if ($user == false || $user->mobile == '') 
		{
			throw new XF_Exception('用户不存在，无法发送信息');
		}
		
		//获取模板
		$event = $this->get(1);
		if ($passwd != NULL)
		{
			$event = $this->get(200);
		}
		//是否已关闭发送
		if ($event->status == '0')
		{
			return;
		}
		
		if ($event->status == '2') //短信
		{
			if ($event->msm_tpl == '')
			{
				throw new XF_Exception('短信模板为空，无法发送！');
			}
			
			$message = str_replace('{mobile}', $user->mobile, $event->msm_tpl);
			if($passwd != NULL)
			{
				$message = str_replace('{password}', $passwd, $message);
			}
			$this->sendSms($user->mobile, $message, 'reg');
		}
	}
	
	/**
	 * 用户：邮箱方式注册激活
	 * @param int $user_id 用户id
	 */
	public function sendByEmailRegisteredSuccess($user_id)
	{
		$mod = new User_Model_User();
		$user = $mod->get($user_id);
		if ($user == false || $user->mobile == '') 
		{
			throw new XF_Exception('用户不存在，无法发送信息');
		}
		
		//获取模板
		$event = $this->get(2);
		
		//是否已关闭发送
		if ($event->status == '0')
		{
			return;
		}
		
		if ($event->status == '1') //邮箱
		{
			if ($event->mail_tpl == '')
			{
				throw new XF_Exception('邮件模板为空，无法发送！');
			}
			
			$content = str_replace('{email}', $user->email, $event->mail_tpl);
			$content = str_replace('{authCodeUrl}', 'http://www.'.XF_Config::getInstance()->getDomain().'/user/front/actEmailAccount?code='.urlencode(XF_Functions::authCode($user_id.'|'.$user->email)), $content);
			$this->sendEmail($user->email, $event->mail_title, $content);
		}
	}
	
	/**
	 * 用户：绑定邮箱，发送提示邮件 【链接2小时内有效】
	 * @param int $user_id 用户id
	 * @param string $email 要绑定的邮箱
	 */
	public function sendByBinConfirmEmail($user_id, $email)
	{
		$mod = new User_Model_User();
		$user = $mod->get($user_id);
		if ($user == false) 
		{
			throw new XF_Exception('用户不存在，无法绑定邮箱');
		}
		
		//邮箱是否正确
		if (XF_String_Validate_Email::validate($email) == false) 
		{
			throw new XF_Exception('邮箱格式不正确！');
		}
		//获取模板
		$event = $this->get(3);
		//是否已关闭发送
		if ($event->status == '0')
		{
			return;
		}
		if ($event->status == '1') //邮箱
		{
			if ($event->mail_tpl == '')
			{
				throw new XF_Exception('邮件模板为空，无法发送！');
			}
			
			$content = str_replace('{username}', $user->nickname, $event->mail_tpl);
			$content = str_replace('{email}', $email, $content);
			$content = str_replace('{authCodeUrl}', 'http://www.'.XF_Config::getInstance()->getDomain().'/user/setting/veryBinEmail?code='. urlencode(XF_Functions::authCode($user_id.'|'.$email.'|'.time())), $content);
			$this->sendEmail($email, $event->mail_title, $content);
		}
	}
	
	/**
	 * 意向订单：预约信息
	 * @param unknown_type $order_id
	 * @throws XF_Exception
	 */
	public function sendByOrderReservContent($order_id)
	{
		//获取订单信息
		$mod = new Order_Model_Order();
		$order = $mod->get($order_id);
		if ($order == false || XF_String_Validate_Mobile::validate($order->mobile) == false) 
		{
			throw new XF_Exception('订单信息不正确，无法发送信息');
		}
		
		//获取模板
		$event = $this->get(23);
		//是否已关闭发送
		if ($event->status == '0')
		{
			return;
		}
		
	
		if ($event->status == '2')  //短信
		{
			if ($event->mail_tpl == '')
			{
				throw new XF_Exception('邮件模板为空，无法发送！');
			}
			
			$content = str_replace('{email}', $user->email, $event->mail_tpl);
			$content = str_replace('{authCodeUrl}', 'http://www.cheduoshao.com/user/', $content);
			$this->sendSms($user->mobile, $message);
		}
	}
	
	public function sendByFindPassword($user_id)
	{
		//获取用户
		$mod = new User_Model_User();
		$user = $mod->get($user_id);
		if ($user == false)
		{
			throw new XF_Exception('用户不存在，无法发送邮件');
		}
		if ($user->email == '')
		{
			throw new XF_Exception('用户邮件为空，无法发送邮件');
		}
		
		//获取模板
		$event = $this->get(4);
		//是否已关闭发送
		if ($event->status == '0')
		{
			return;
		}
		$authCodeUrl = 'http://www.'.XF_Config::getInstance()->getDomain().'/findPassword/?fromMailCode='.urlencode(XF_Functions::authCode($user->user_id.','.$user->password.','.time()));
		$content = str_replace('{email}', $user->email, $event->mail_tpl);
		$content = str_replace('{authCodeUrl}', $authCodeUrl, $content);
		$this->sendEmail($user->email, $event->mail_title, $content);
		
	}
	
	/**
	 * 发送验证码
	 * @param string $mobile 手机号码
	 * @param int $smsCode 验证码
	 * @throws XF_Exception
	 */
	public function sendSmsCode($mobile, $smsCode)
	{
		if (XF_String_Validate_Mobile::validate($mobile) == FALSE)
		{
			throw new XF_Exception('手机号码错误！');
		}
		
		//获取模板
		$event = $this->get(100);
		if ($event->status == '0')
		{
			return FALSE;
		}
		
		//短信
		if ($event->status == '2')
		{
			if ($event->msm_tpl == '')
			{
				throw new XF_Exception('短信模板为空，无法发送！');
			}
			
			$message = str_replace(array('{smsCode}', '{mobile}', '{hour}', '{minute}'), array($smsCode, $mobile, date('H'), date('i')), $event->msm_tpl);
			
			$status = $this->sendSms($mobile, $message, 'code');
			if ($status == TRUE)
			{
				$mem = XF_Cache_Memcache::getInstance();
				$mem->setCacheTime(10);
				$mem->add($mobile.'_'.$smsCode, $smsCode);
			}
			return $status;
		}
		
		return FALSE;
	}
	
	
	
	
	/**
	 * 发送短信息
	 * @param int $mobile 接收手机号
	 * @param string $message 消息内容
	 * @param string $type 发送类型 code:验证码 reg:注册 other:其它
	 * @return bool 是否成功
	 */
	public function sendSms($mobile, $message, $type = 'other')
	{
		/*$list = array('13502581563','13736913577');
		if (in_array($mobile, $list))
		{
			return false;
		}*/
		

		
		if (XF_DataPool::getInstance()->get('RequestFromApp') !== true)
		{
			/*if (
					strpos(XF_Controller_Request_Http::getInstance()->getHeader('Referer'), '.souchela.com') === false &&
					strpos(XF_Controller_Request_Http::getInstance()->getHeader('Referer'), '.gongpingjia.com') === false 
					
			)
			{
				throw new XF_Exception('非法的请求');
			}
			if (strpos($_SERVER['HTTP_USER_AGENT'], '.NET CLR 3.5.21022'))
			{
				throw new XF_Exception('非法的请求');
			}*/
		}
		

		
		$mod = new Application_Model_SmsSenderLog();
		if ($type == 'code')
		{
			//每个手机号每小时最多10条
			$where = array(
				'mobile' => $mobile,
				'created,>' => date('Y-m-d H').':00:00',
				'created,<' => date('Y-m-d H', strtotime(date('Y-m-d H').':00:00') + 3600).':00:00'
			);
			$c = $mod->select()->setWhere($where)->fetchCount();
			if ($c >= 10)
			{
				throw new XF_Exception('您今日发送短信次数已超出上限');
			}
			
			//每个ip一天多最30条
			$ip = XF_Controller_Request_Http::getInstance()->getClientIp();
			if ($ip != '119.161.222.193')
			{
				$where = array('ip' => XF_Controller_Request_Http::getInstance()->getClientIp(), 'created,>' => date('Y-m-d 00:00:00'));
				$c = $mod->select()->setWhere($where)->fetchCount();
				if ($c >= 10)
				{
					throw new XF_Exception('您今日发送短信次数已超出上限');
				}
			}
			
			//每个手机号一天多最30条
			$tmp = array(
				/*'18601021305',
				'13488790156',
				'13611216850',
				'13691334650',
				'15010156676',
				'13718187856',
					
				'13701242648',
				'13910250340',
				'18911697907'*/
			);
			$where = array('mobile' => $mobile, 'created,>' => date('Y-m-d 00:00:00'), 'mobile,notin' => $tmp);
			$c = $mod->select()->setWhere($where)->fetchCount();
			if ($c >= 10)
			{
				throw new XF_Exception('您今日发送短信次数已超出上限');
			}
		}
		//每个手机号码2分钟内只能发送一次
		$log = $mod->getByMobile($mobile);
		if ($log != false)
		{
			$use = time() - strtotime($log->created);
			if ($use < 120 && $type == 'code')
			{
				throw new XF_Exception((120 - $use).'秒之后才能再次发送');
			}	
		}
		
		$sms_sender_log_id = Application_Model_SmsSenderLog::add($mobile, $message, $type);
		
		if ($this->_sender !== NULL)
		{
			$this->_sender->send($mobile, $message);
			Application_Model_SmsSenderLog::updateSource($sms_sender_log_id, $this->_sender->getSourceId());
			$status = $this->_sender->isOk();
			Application_Model_SmsSenderLog::updateSendMessage($sms_sender_log_id, $this->_sender->getMessage());
			if ($status == TRUE)
			{
				Application_Model_SmsSenderLog::updateComplete($sms_sender_log_id);
				return TRUE;
			}
			return FALSE;
		}
		
		///////依次发送
		$senders = array(
			'Application_Model_SmsSenderSms7'
		);
		try 
		{
			foreach ($senders as $s)
			{
				$sender = new $s();
				$sender->send($mobile, $message);
				Application_Model_SmsSenderLog::updateSource($sms_sender_log_id, $sender->getSourceId());
				Application_Model_SmsSenderLog::updateSendMessage($sms_sender_log_id, $sender->getMessage());
				if ($sender->isOk())
				{
					Application_Model_SmsSenderLog::updateComplete($sms_sender_log_id);
					return TRUE;
				}
			}
		}
		catch (Exception $e)
		{
			return FALSE;
		}
		return FALSE;
	}
	
	/**
	 * 发送邮箱
	 * @param string $email 邮箱地址
	 * @param string $title 标题
	 * @param string $content html内容
	 * @param string $text 文内容
	 * @return bool 是否成功
	 */
	public function sendEmail($email, $title, $content, $text = NULL)
	{
		require_once XF_PATH."/Custom/PHPMailer/class.phpmailer.php";
		
		$config = XF_Config::getInstance()->load('common');
		$config = $config->common->smtp;

		//下面是几个不常用到的变量
		$charset = empty($config["charset"]) ? 'UTF-8' : $config["charset"];
		$encode = empty($config["encoding"]) ? 'base64' : $config["encoding"];
		$debug = empty($config["debug"]) ? false : $config["debug"];

		//初始化邮件类
		$mail = new PHPMailer();
		$mail->IsSMTP();                           // send via SMTP
		$mail->Host        = $config["server"];      // SMTP servers
		$mail->SMTPAuth    = true;                 // turn on SMTP authentication 开启验证
		$mail->Username    = $config["username"];      // SMTP username  注意：普通邮件认证不需要加 @域名
		$mail->Password    = $config["password"];      // SMTP password
		$mail->From        = $config["fromUserEmail"];      // 发件人邮箱
		$mail->FromName    = $config["fromUserName"];      // 发件人
		$mail->CharSet     = $charset;             // 这里指定字符集！
		$mail->Encoding    = $encode;              // 编码方式
		$mail->SMTPDebug   = $debug;               // 调试用的开关
		$mail->AddReplyTo($config["username"],$config["fromUserName"]);
	
		if (!empty($config["gmail"]))
		{
			$mail->SMTPSecure = empty($config["secure"])?'ssl':$config["secure"];
			$mail->Port = empty($config["port"])?465:$config["port"];
		}
		$mail->Subject = $title;
		if($content == null && $text != null)
		{
			$mail->IsHTML(false);			
			$mail->Body = $text;
		}
		else
		{
			$mail->IsHTML(true);
			$mail->AltBody = $text;  //不支持html格式时，显示的文本
			$mail->Body = $content;//html信体
		}
		$mail->AddAddress($email,$user);
		return $mail->Send();
	}
}
