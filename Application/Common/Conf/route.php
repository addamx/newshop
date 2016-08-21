<?php
return array(
    'URL_MODEL'            => 1,
    'URL_CASE_INSENSITIVE' => false,
    'URL_ROUTER_ON'        => true, // 开启路由
    'URL_ROUTE_RULES'      => array(
        'test' => 'Home/Index/test',

    ),
    'URL_HTML_SUFFIX'      => 'html', // URL伪静态后缀设置  默认为html  去除默认的 否则很多地址报错
);
