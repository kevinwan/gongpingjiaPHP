<?php
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
define( 'XF_PATH' , realpath(APPLICATION_PATH . '/../../xf'));
define( 'TEMP_PATH' , APPLICATION_PATH . '/../temp');
require XF_PATH.'/Application.php';
$application = XF_Application::getInstance(false,false);

switch ($_SERVER['HTTP_HOST'])
{
    case 'www.gpj.com':
        $application->setBootstrap('Front')->run();
        break;
    default:
        $application->setBootstrap('Main')->run();

}
