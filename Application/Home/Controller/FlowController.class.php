<?php
namespace Home\Controller;

use Common\Controller\HomeController;

class FlowController extends HomeController
{
    public function _initialize()
    {
        parent::_initialize();
        if (!session('?user')) {
            $this->redirect('User/login', '', 1, '请先登录, 页面跳转中...');
            exit;
        }
    }
    //购物车压面
    public function add($goods_id = '', $goods_qty = '1')
    {
        $goods_model = D('Goods');
        $cart        = \Home\Tool\CartTool::getIns();
        if (!empty($goods_id)) {
            //检查goods_id
            $info = $goods_model->getOne(I('goods_id'));
            if (!$info) {
                $this->redirect('/');
                exit;
            }
            $cart->add($info['id'], $info['name'], $info['shop_price'], I('get.goods_qty'));
        }

        $buy_list = array();
        $items    = $cart->items();
        foreach ($items as $key => $value) {
            $i              = $goods_model->find($key);
            $i['num']       = $value['num'];
            $i['thumb_img'] = UPLOAD_URL . explode(',', $i['thumb_img'])[0];
            $buy_list[]     = $i;
        }

        $this->assign('buy_list', $buy_list);
        $this->assign('money', $cart->calcMoney());
        $this->display();

    }

    //准备生成订单
    public function checkout()
    {

        if (!IS_POST || !session('?cart')) {
            exit;
        }
        //更新购物车的商品数量
        $info = I('post.info');
        $cart = session('cart');

        foreach ($info as $k => $v) {
            if (array_key_exists($k, $cart)) {
                $cart[$k]['num'] = $v['num'];
            }
        }
        session('cart', $cart);

        $goods_model = D('Goods');
        $cart        = array();
        foreach (session('cart') as $key => $value) {
            $i              = $goods_model->find($key);
            $i['num']       = $value['num'];
            $i['thumb_img'] = UPLOAD_URL . explode(',', $i['thumb_img'])[0];
            $cart[]         = $i;
        }

        $cartins = \Home\Tool\CartTool::getIns();
        $ttl     = $cartins->calcMoney();

        $this->assign('ttl', $ttl);
        $this->assign('cart', $cart);
        $this->display();
    }

    public function done()
    {
        $oi   = D('Ordinfo');
        $og   = D('Ordgoods');
        $cart = \Home\Tool\CartTool::getIns();

        $post = I('post.');
        //写入ordinfo表
        $post['user_id'] = session('user')['id'];
        $post['money']   = $cart->calcMoney();

        $ordinfo_id = '';

        if (!$oi->create($post)) {
            $this->exError($oi->getError(), '', 3);
            exit;
        }

        if (($ordinfo_id = $oi->add()) == false) {
            echo 'yyy';
            $this->error('下单失败', '', 2);
            exit;
        }

        //写入ordgoods表
        $data = array();

        foreach ($cart->items() as $k => $v) {
            $row               = array();
            $row['ordinfo_id'] = $ordinfo_id;
            $row['goods_id']   = $k;
            $row['goods_name'] = $v['goods_name'];
            $row['shop_price'] = $v['shop_price'];
            $row['num']        = $v['num'];
            $data[]            = $row;
        }

        if (!$og->addAll($data)) {
            //addAll批量写入
            $oi->delete($ordinfo_id);
            $og->where(array('ordinfo_id' => $ordinfo_id))->delete();
            $this->error('下单失败', '', 2);
            exit;
        }
        $info = $oi->find($ordinfo_id);
        $this->assign('info', $info);

        //清空购物车
        $cart->clear();

        //支付

        //var_dump($oi->find($ordinfo_id));
        $this->display();

    }

}
