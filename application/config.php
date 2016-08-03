<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

return [
    'url_route_on'        => true,
    'log'                 => [
        'type' => 'file', // 支持 socket trace file
    ],

    'default_module'      => 'admin',
    'default_ajax_return' => 'json',
	'app_debug' =>  true,
	
	'MG_DB' => [
    // 数据库类型
    'type'        => 'mysql',
    // 服务器地址
    'hostname'    => '192.168.1.227',
    // 数据库名
    'database'    => 'HT_MGDB',
    // 数据库用户名
    'username'    => 'root',
    // 数据库密码
    'password'    => '123456',
    // 数据库编码默认采用utf8
    'charset'     => 'utf8',
    // 数据库表前缀
    'prefix'      => '',
],
//数据库配置2
'LOG_DB' => [
    // 数据库类型
    'type'        => 'mysql',
    // 服务器地址
    'hostname'    => '192.168.1.227',
    // 数据库名
    'database'    => 'HT_LOGDB',
    // 数据库用户名
    'username'    => 'root',
    // 数据库密码
    'password'    => '123456',
    // 数据库编码默认采用utf8
    'charset'     => 'utf8',
    // 数据库表前缀
    'prefix'      => '',
],
	
	
//数据库配置3
'IM_DB' => [
    // 数据库类型
    'type'        => 'mysql',
    // 服务器地址
    'hostname'    => '192.168.1.227',
    // 数据库名
    'database'    => 'HT_IMDB',
    // 数据库用户名
    'username'    => 'root',
    // 数据库密码
    'password'    => '123456',
    // 数据库编码默认采用utf8
    'charset'     => 'utf8',
    // 数据库表前缀
    'prefix'      => '',
],	
	
	
	
	
	
	
];
