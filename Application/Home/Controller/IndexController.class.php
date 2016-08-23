<?php
namespace Home\Controller;

use Common\Controller\HomeController;

class IndexController extends HomeController
{
    public function index()
    {
        $good_model = D('Goods');
        $hotlist    = $good_model->where(array('is_delete' => '0', 'is_hot' => '1'))->limit(4)->select();
        $newlist    = $good_model->where(array('is_delete' => '0', 'is_new' => '1'))->limit(4)->select();
        $this->assign('hotlist', $hotlist);
        $this->assign('newlist', $newlist);

        //var_dump($this->exGoodCates());
        $this->display();
    }

    public function feed()
    {
        $list = array(
            array('title' => '商品1', 'dcrp' => 'asdfasdf'),
            array('title' => '商品2', 'dcrp' => 'asdfasdf'),
        );
        $feed              = new \Common\Util\Feed();
        $feed->title       = '布尔商城';
        $feed->link        = SITE_URL;
        $feed->description = '这是商城的优惠信息集合';
        $feed->items       = $list;
        $feed->display();
    }

    public function test()
    {
        //$Ip   = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
        //$area = $Ip->getlocation('203.34.5.66'); // 获取某个IP地址所在的位置
        //$ip = get_client_ip();
        testt();

    }

    public function category($cid = '')
    {

        $cate_list = $this->exGoodCates(I('get.cid'));
        $ct_list   = '';
        foreach ($cate_list as $v) {
            $ct_list .= $v['id'] . ',';
        }
        $ct_list                = rtrim($ct_list, ',');
        $condition['is_sale']   = 1;
        $condition['is_delete'] = 0;
        $condition['cat_id']    = array('IN', $ct_list);
        $condition['_logic']    = 'AND';
        $goods                  = D('Goods')->where($condition)->select();
        $this->assign('cat_goods', $goods);

        $this->assign('cid', I('get.cid'));

        $this->display();
    }

}
