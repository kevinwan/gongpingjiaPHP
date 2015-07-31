<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
echo $this->getView()->headLink();
echo $this->getView()->headTitle();
echo $this->getView()->headMeta();
?>
<script src="$static/js/jquery/jquery-1.11.1.js"></script>
<script src="$static/js/layer/layer.js"></script>
<script src="$static/js/common.js"></script>
<?php echo $this->getView()->headScript();?>
<link rel="stylesheet" href="$static/css/base.css"  />
<?php echo $this->getView()->headStylesheet();?>
</head>
<body>
<?php
echo funcGetDebugContent();
require_once APPLICATION_PATH.'/layouts/scripts/header.php';
?>
<?php echo $this->{'$layoutContent'}?>
<?php
require_once APPLICATION_PATH.'/layouts/scripts/selectcity.php';
?>
<?php
require_once APPLICATION_PATH.'/layouts/scripts/footer.php';
?>
<?php
//打印debug信息
if(XF_Controller_Request_Http::getInstance()->getParam('debug') == 'true')
{
	echo funcGetDebugContent();
}
?>
</body>
</html>

