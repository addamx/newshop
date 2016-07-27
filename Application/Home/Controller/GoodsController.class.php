<?php
namespace Home\Controller;

use Common\Controller\HomeController;

class GoodsController extends HomeController {

	public function index() {
		$goods = D('Goods')->getAll();
        $this->assign('goods', $goods);

        $this->assign('goodcates', $this->exGoodCates());   

        $this->display();
	}

	public function detail($gid='') {
		if(!$gid) {
			exit;
		}
		$info = D('Goods')->find(I('get.gid'));
		$this->his($info);

		$info['goods_img'] = explode(',', $info['goods_img']);
		$info['thumb_img'] = explode(',', $info['thumb_img']);

        $this->assign('info', $info);
		$this->assign('goodcates', $this->exGoodCates()); 
		$this->display();
	}

	//wait
	public function comment() {
		if(IS_POST) {

		}
		$goods_model= D('Goods');
		$comms = $goods_model->relation('Comment')->find(I('get.id'));

	}


	//历史记录(3个商品的goods_id, goods_name和shop_price)
	protected function his($goodsinfo) {
		$goods_name = $goodsinfo['name'];
		$shop_price = $goodsinfo['shop_price'];
		$goods_id = $goodsinfo['id'];
		$his = session('?his') ? session('his') : array();
		if(count($his)>5) {	//如果大于5个商品, 则删除第一个(最旧的)
			$k = key($his);	//获取当前指针指向的key, 也就是第一个;
			unset($his[$k]);
		}
		$his[$goods_id] = array(
				'goods_id'=>$goods_id,
				'good_name'=>$goods_name,
				'shop_price'=>$shop_price,
			);
		session('his', $his);
	}

}