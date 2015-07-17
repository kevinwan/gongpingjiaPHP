<?php

////// 卖车估值
$router->addRewrite('sellReport',
    new XF_Controller_Router_Rewrite(
        array(
            '/^\/sellreport\/(\d+)\/$/',
            '/^\/sellreport\/(\d+)\/(.*?)\/(.*?)\/(.*?)\/(.*?)\/$/',
	),
	array(
            'module' => 'report',
            'controller' => 'index',
            'action' => 'sellReport'
	),
	array(
            '0:1' => 'serialId',
            '1:1' => 'serialId',
            '1:2' => 'city',
            '1:3' => 'year',
            '1:4' => 'typeId',
            '1:5' => 'mileage',					
	)
    )
);

