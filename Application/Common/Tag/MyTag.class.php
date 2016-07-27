<?php
namespace Common\Tag;

use Think\Template\TagLib;

class MyTag extends TagLib
{
    protected $tags = array(
        'jquery'  => array('attr' => '', 'close' => '0'),
        'ueditor' => array('attr' => 'target', 'close' => '0'),
    );

    public function _jquery()
    {
        $str = '<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>';
        return $str;
    }
    public function _ueditor($tag)
    {
        $target = $tag['target'];
        $url    = SITE_URL . '/Public/component/ueditor/';
        $str    = <<<php
<script type="text/javascript" src="{$url}ueditor.config.js"></script>
<script type="text/javascript" src="{$url}ueditor.all.js"></script>
<script type="text/javascript">
    var ue = UE.getEditor("$target");
</script>
php;
        return $str;
    }
}
