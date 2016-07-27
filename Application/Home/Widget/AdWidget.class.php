<?php
namespace Home\Widget;

use Think\Controller;

class AdWidget extends Controller 
{
    public function aw(){
    	$list = array(
    			array('title' => '广告一', 'link'=>'xxxx/ad1.html'),
    			array('title' => '广告二', 'link'=>'xxxx/ad1.html'),
    			array('title' => '广告三', 'link'=>'xxxx/ad1.html'),
    			);
        $this->assign('list',$list);
        $this->display('Ad:aw');
    }
}