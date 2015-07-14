<?php

/**
 * 图片处理程序
 * @author abiao 2015-7-14
 */
ini_set('display_errors', '1');
set_time_limit(0);
ini_set('date.timezone', 'PRC');
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
define( 'XF_PATH' , realpath(APPLICATION_PATH . '/../../xf'));
define( 'TEMP_PATH' , APPLICATION_PATH . '/../temp');

require XF_PATH.'/Application.php';
$application = XF_Application::getInstance(TRUE, FALSE);

require XF_PATH.'/Custom/PHPThumb/ThumbLib.inc.php';

$file = 'http://gongpingjia.qiniudn.com/'.$_GET['file'];
$saveFile = '';
$location = '';
$width = $height = 0;

//图片 90*60
if ($_GET['type'] == '96x')
{
	$width = 90;
	$height = 60;
	$saveFile = APPLICATION_PATH.'/../static/cacheimg/96/'.$_GET['file'];
	$location = 'http://static.souchela.com/cacheimg/96/'.$_GET['file'];
}

//图片 120*80
if ($_GET['type'] == '128x')
{
	$width = 120;
	$height = 80;
	$saveFile = APPLICATION_PATH.'/../static/cacheimg/128/'.$_GET['file'];
	$location = 'http://static.souchela.com/cacheimg/128/'.$_GET['file'];
}

//图片 144*96
if ($_GET['type'] == '14496x')
{
	$width = 144;
	$height = 96;
	$saveFile = APPLICATION_PATH.'/../static/cacheimg/14496/'.$_GET['file'];
	$location = 'http://static.souchela.com/cacheimg/14496/'.$_GET['file'];
}

//图片 150*100
if ($_GET['type'] == '1510x')
{
	$width = 150;
	$height = 100;
	$saveFile = APPLICATION_PATH.'/../static/cacheimg/1510/'.$_GET['file'];
	$location = 'http://static.souchela.com/cacheimg/1510/'.$_GET['file'];
}

//图片 180*120  首页下方的二手车图
if ($_GET['type'] == '1812x')
{
	$width = 180;
	$height = 120;
	$saveFile = APPLICATION_PATH.'/../static/cacheimg/1812/'.$_GET['file'];
	$location = 'http://static.souchela.com/cacheimg/1812/'.$_GET['file'];
}

//图片 220*150  首页下方的二手车图
if ($_GET['type'] == '2215x')
{
	$width = 220;
	$height = 150;
	$saveFile = APPLICATION_PATH.'/../static/cacheimg/2215/'.$_GET['file'];
	$location = 'http://static.souchela.com/cacheimg/2215/'.$_GET['file'];
}

//图片 280*180  首页下方的二手车图
if ($_GET['type'] == '2818x')
{
	$width = 280;
	$height = 180;
	$saveFile = APPLICATION_PATH.'/../static/cacheimg/2818/'.$_GET['file'];
	$location = 'http://static.souchela.com/cacheimg/2818/'.$_GET['file'];
}


if ($_GET['type'] == '19812x')
{
	$width = 198;
	$height = 120;
	$saveFile = APPLICATION_PATH.'/../static/cacheimg/19812/'.$_GET['file'];
	$location = 'http://static.souchela.com/cacheimg/19812/'.$_GET['file'];
}

if ($_GET['type'] == 'gray19812x')
{
	$width = 198;
	$height = 120;
	$saveFile = APPLICATION_PATH.'/../static/cacheimg/gray19812/'.$_GET['file'];
	$location = 'http://static.souchela.com/cacheimg/gray19812/'.$_GET['file'];
}



if (is_file($saveFile))
{
	header('Location:'.$location);
	exit;
}
	
$thumb = PhpThumbFactory::create($file);
$thumb->adaptiveResize($width, $height);

//创建目录
$path = pathinfo($saveFile);
XF_File::mkdirs($path['dirname']);

//保存图片
if(strpos($_GET['type'],'gray') === false)
{
    $thumb->save($saveFile);
}
else 
{
    $thumb->saveGray($saveFile);
}

header('Location:'.$location);

