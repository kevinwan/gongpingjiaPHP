<?php
/**
 * 短信提醒到BD人员
 * @param string $message 提醒内容
 */
function funcPutMsmMessageToBD($message)
{
	//return;
	$phones = array(
		//'13811164584',
		//'13811111248',
		'13260266954',
		//'18911150708',
		//'15001300176',
		//'13260266954',
		//'13901370330',
	);
	

	//国庆
	/*if (in_array(date('d'), array('01', '02', '03', '04', '05', '06', '07')))
	{
		$mod = new Application_Model_MailSmsEvent();
		foreach ($phones as $phone)
		{
			$mod->sendSms($phone, $message, 'other');
		}
	}*/
	
	//当天是星期五、六、日
	if (in_array(date('w'), array('0','5','6')))
	{
		//周期五18点后才提醒
		if (date('w') == '5' && date('H') < 18)
		{
			return;
		}
		if (date('w') != '0')
		{
			return;
		}
			
		$mod = new Application_Model_MailSmsEvent();
		foreach ($phones as $phone)
		{
			$mod->sendSms($phone, $message, 'other');
		}
	}
}


/**
 * 格式化一个时间，输出类似：2分钟前
 * @param mixed $time 时间戳或时间字符串
 * @return string
 */
function funcFormatTime($time)
{
	if (!is_numeric($time))
		$time = strtotime($time);
		
	$t = time()-$time;
	switch ($t)
	{
		case $t < 60:
            return '1分钟前';
        case $t < 3600:
            return ceil($t/60).'分钟前';
        case $t < 3600*24:
            return ceil($t/3600).'小时前';
        case $t < 3600*24*7:
            return ceil($t/(3600*24)).'天前';
        case $t < 3600*24*30:
            return ceil($t/(3600*24*7)).'周前';
        case $t < 3600*24*365:
            return ceil($t/(3600*24*30)).'个月前';
        default:
        	return ceil($t/(3600*24*365)).'年前';
	}
}

/**
 * 格式化一个时间，输出类似：今天 昨天 前天 3天前 1周前 1个月前 1年前
 * @param mixed $time 时间戳或时间字符串
 * @return string
 */
function funcFormatTimeToDay($time)
{
	if (!is_numeric($time))
		$time = strtotime($time);
		
	$t = time()-$time;
	switch ($t)
	{
		case $time >= strtotime(date('Y-m-d 00:00:00'))  && $time <= strtotime(date('Y-m-d 23:59:59')):
            return '今天';
        case $time >= strtotime(date('Y-m-d 00:00:00', strtotime('-1 day')))  && $time <= strtotime(date('Y-m-d 23:59:59', strtotime('-1 day'))):
            return '昨天';
        case $time >= strtotime(date('Y-m-d 00:00:00', strtotime('-2 day')))  && $time <= strtotime(date('Y-m-d 23:59:59', strtotime('-2 day'))):
            return '前天';
        case $t < 3600*24*7:
            return ceil($t/(3600*24)).'天前';
        case $t < 3600*24*30:
            return ceil($t/(3600*24*7)).'周前';
        case $t < 3600*24*365:
            return ceil($t/(3600*24*30)).'个月前';
        default:
        	return ceil($t/(3600*24*365)).'年前';
	}
}


/**
 * 提交一个需要执行的任务到队列服务器
 * @param string $name 调用名称 例：sale.update
 * @param Array $params 方法需要的参数
 * @return void
 */
function funcRun($name, Array $params = NULL)
{
	//require_once XF_PATH.'/Custom/HttpSQS.php';
	
	$tmp = explode('.', $name);
	if (count($tmp) != 2 )
	{
		throw new XF_Exception('调用名称格式不正确');
	}
	$queue_data = array(
		'model' => $tmp[0],
		'func' => $tmp[1],
		'params' => $params,
	);
	Application_Model_PHPTask::add($tmp[0], $tmp[1], $params, '1');
}

/**
 * 程序框加调试信息，主要用于开发测试
 */
function funcGetDebugContent()
{
	//$session = new XF_Session('XF_Role');
	//if ($session->isEmpty() == false && $session->read() == 1 && XF_Controller_Request_Http::getInstance()->getParam('debug') == 'true')
	//{
			echo "<pre>Debug info";
			echo "\n\nRequest URL: ".XF_Controller_Request_Http::getInstance()->getRequestUrl();
			echo "\n\nExceptionMessage: ".XF_DataPool::getInstance()->get('ExceptionMessage')."\n";
			echo "\nParams:\n";
			print_r(XF_Controller_Request_Http::getInstance()->getParams());
			echo "\nRewrites: \n";
			$debug = XF_DataPool::getInstance()->get('DEBUG');
	        print_r($debug['Rewites']);
			
	        $_querys = XF_DataPool::getInstance()->get('ConnectionMysql', array());
			echo '<br/>Connection Mysql('.count($_querys).') Time:'.XF_DataPool::getInstance()->get('ConnectionMysqlTimeCount', '0s').'<br/>' ;
			print_r($_querys);
			
	        $_querys = XF_DataPool::getInstance()->get('Querys', array());
			echo '<br/>Querys('.count($_querys).') Time:'.XF_DataPool::getInstance()->get('QueryTimeCount', '0s').'<br/>' ;
			print_r($_querys);
			$_solrs = XF_DataPool::getInstance()->get('Solrs', null);
			if (is_array($_solrs))
			{
				echo '<br/>Solrs('.count($_solrs).') Time:'.XF_DataPool::getInstance()->get('SolrTimeCount', '0s').'<br/>' ;
				print_r($_solrs);
			}
			echo '<br/>ReadCache('.XF_DataPool::getInstance()->get('CacheTimeCount', 0).'s)<br/>';
			print_r(XF_DataPool::getInstance()->get('CacheTimeList'));
			echo '<br/>RunApplication:'.XF_DataPool::getInstance()->get('RunApplication').'s';
			echo '<br/>RunBootstrap:'.XF_DataPool::getInstance()->get('RunBootstrap').'s';
			echo '<br/>RunBootstraps:';
			print_r(XF_DataPool::getInstance()->get('Bootstrap_Inits'));
                        echo '<br/>Load_Interface:';
                        print_r(XF_DataPool::getInstance()->get('Load_Interface'));
			echo '<br/>LoadFile:'.sprintf("%.5fs", XF_Application::getInstance()->loadFileTime());
			echo '<br/>RunTime:'.sprintf("%.5fs", microtime(true)-APP_START_TIME);
			echo "</pre>";
			
	//}
}

/**
 * 格式化一个时间，输出类似：还剩多少天
 * @param mixed $time 时间戳或时间字符串
 * @return string
 */
function funcFormatResidueTime($time)
{
	if (!is_numeric($time))
	{
		if (date('Y-m-d') == $time)
		{
			return '剩余1天';
		}
		$time = strtotime($time);
	}
		
		
	$t = $time - time();
	switch ($t)
	{
		case $t < 60:
            return '剩余1分钟';
        case $t < 3600:
            return '剩余'.ceil($t/60).'分钟';
        case $t < 3600*24:
            return '剩余'.ceil($t/3600).'小时';
        case $t < 3600*24*7:
            return '剩余'.ceil($t/(3600*24)).'天';
        case $t < 3600*24*30:
            return '剩余'.ceil($t/(3600*24*7)).'周';
        case $t < 3600*24*365:
            return '剩余'.ceil($t/(3600*24*30)).'个月';
        default:
        	return '剩余'.ceil($t/(3600*24*365)).'年';
	}
}

/**
 * 格式化一个时间，输出类似：还剩多少天
 * @param mixed $time 时间戳或时间字符串
 * @return string
 */
function funcFormatSolrTime($time='')
{
	if (empty($time))
		$time = time();
		
	if (!is_numeric($time))
		$time = strtotime($time);
	
	$nowDate = date('Y-m-d H:i:s',$time);
	$Date = explode(" ", $nowDate);
	return  $Date[0].'T'.$Date[1].'Z';
}

/**
 * 获取指定地区4s店的数量
 * @param int $province_id 地区ID
 * @return number
 */
function funcGetDealerCount($province_id)
{
	$mod = new Dealer_Model_Dealer();
	return $mod->select()->setWhere(array('province_id' => $province_id, 'grade' => '0'))->fetchCount();
}

/**
 * 获取短URL
 * @param string $url 原始url【勿用urlencode】
 * @return string 短URL
 */
function funcGetSortUrl($url)
{
	$url = 'http://usmag.cn/api.php?url='.urlencode($url);
	return file_get_contents($url);
}


