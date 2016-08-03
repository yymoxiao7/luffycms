<?php
//配置文件
return [
    'login_session_identifier' => '_L', // 登录标识
    'no_auth_controller_name'  => 'index', // 不需要验证的控制器

    'paginate'                 => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'namespace' => '\\app\\admin\\paginator\\',
    ],
];
