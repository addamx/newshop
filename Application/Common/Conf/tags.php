<?php
return array(
    // 添加下面一行定义即可
    //'view_filter' => array('Behavior\TokenBuild'),
    // 如果是3.2.1以上版本 需要改成
    'view_filter' => array('Behavior\TokenBuildBehavior'),
    //view_filter 视图输出过滤标签位
    //'app_end'=>array('Behavior\ChromeShowPageTraceBehavior'),
);
