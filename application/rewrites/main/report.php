<?php

////// 卖车估值
$router->addRewrite('sellReport',
    new XF_Controller_Router_Rewrite(
        array(
            '/^\/sellreport\/$/',
            '/^\/sellreport\/(.*?)\/?s(\d)m(\d+)ax(\d+)f(\d+)\/$/',
            '/^\/(.*?)\/discountnew\/$/',
            '/^\/(.*?)\/discountnew\/(.*?)\/?s(\d)m(\d+)ax(\d+)f(\d+)\/$/',
	),
	array(
            'module' => 'default',
            'controller' => 'index',
            'action' => 'discountNew'
	),
	array(
            '1:1' => 'brand_py',
            '1:2' => 'style',
            '1:3' => 'min_price',
						'1:4' => 'max_price',
						'1:5' => 'flatly',
						'2:1' => 'city',
						'3:1' => 'city',
						'3:2' => 'brand_py',
						'3:3' => 'style',
						'3:4' => 'min_price',
						'3:5' => 'max_price',
						'3:6' => 'flatly',
						
				)
		)
);

