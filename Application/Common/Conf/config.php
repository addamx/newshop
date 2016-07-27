<?php
return array(
    //'配置项'=>'配置值'

    'URL_MODEL'            => 2, //0 普通模式 1 pathinfo 2 rewrite 3 兼容模式
    'SHOW_PAGE_TRACE'      => true,
    'URL_CASE_INSENSITIVE' => false,

    /* 数据库设置 */
    'DB_TYPE'              => 'mysql', // 数据库类型
    'DB_HOST'              => 'localhost', // 服务器地址
    'DB_NAME'              => 'newshop', // 数据库名
    'DB_USER'              => 'root', // 用户名
    'DB_PWD'               => 'net691029', // 密码
    'DB_PORT'              => '3306', // 端口
    'DB_PREFIX'            => 'newshop_', // 数据库表前缀
    'DB_DEBUG'             => true, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'      => true, // 启用字段缓存
    'DB_CHARSET'           => 'utf8', // 数据库编码默认采用utf8

    /*设置标签库*/
    //'TAGLIB_LOAD'          => true,
    //'TAGLIB_PRE_LOAD'      => 'Common\Tag\MyTag',
    'TAGLIB_BUILD_IN'      => 'Cx,Html,Common\Tag\MyTag', //**注意! 不能有空格!

    /*Auth设置*/
    'AUTH_CONFIG'          => array(
        'AUTH_ON'           => true, // 认证开关
        'AUTH_TYPE'         => 1, // 认证方式，1为实时认证；2为登录认证。
        'AUTH_GROUP'        => 'newshop_auth_group', // 用户组数据表名
        'AUTH_GROUP_ACCESS' => 'newshop_auth_group_access', // 用户-用户组关系表
        'AUTH_RULE'         => 'newshop_auth_rule', // 权限规则表
        'AUTH_USER'         => 'newshop_mg_users', // 用户信息表
    ),

    'SESSION_OPTIONS'      => array(
        //'name'                =>  'BJYSESSION',                    //设置session名
        'expire'        => 24 * 3600,
        'use_trans_sid' => 1, //跨页传递
    ),

    #'SESSION_TYPE'         => 'Redis',
    'REDIS_HOST'           => '127.0.0.1',
    'REDIS_PORT'           => '6379',
    //'SESSION_TIMEOUT'      => '86400', //24h
    // 'SESSION_PERSISTENT'   => false,

    //缓存设置
    #'DATA_CACHE_TYPE'      => 'Redis',
    'DATA_CACHE_PREFIX'    => 'newshop_',

    //表单令牌验证
    'TOKEN_ON'             => false, // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'           => '__hash__', // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'           => 'md5', //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'          => true, //令牌验证出错后是否重置令牌 默认为true

    //自定义错误页面
    //'ERROR_PAGE' =>'/Public/error.html'

    /**模块部署
     *[当着两条设置同时存在时, 访问http://servername/Goods/Index 相当于访问http://servername/Home/Goods/Index]
     **/
    'DEFAULT_MODULE'       => 'Home', // (TP默认模块为Home)
    'MODULE_ALLOW_LIST'    => array('Admin', 'Home'),
    'MODULE_DENY_LIST'     => array('Common', 'Runtime'), // 设置禁止访问的模块列表

    'APP_DOMAIN_SUFFIX'    => '', // 域名后缀 如果是com.cn net.cn 之类的后缀必须设置
    'ACTION_SUFFIX'        => '', // 操作方法后缀
    'URL_HTML_SUFFIX'      => 'html', // URL伪静态后缀设置, 此时/action_name 或者 /action.html才能成功访问
);
