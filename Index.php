<?php
//项目入口那件
//header("content-type:text/html;charset=utf-8");

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('require PHP > 5.3.0 !');
}

define('APP_DEBUG', true);

define('APP_PATH', './Application/');

//定义所有模块的使用视图的路径(conf的VIEW_PATH必须没设置)
define('TMPL_PATH', APP_PATH . 'tpl/');

define("UPLOAD_PATH", APP_PATH . "Public/upload/");

define("SITE_URL", "http://devenv/newshop/Application/");
define("UPLOAD_URL", SITE_URL . "Public/upload/");

//define('BIND_MODULE', 'Admin');
require './ThinkPHP/ThinkPHP.php';
