<?php
namespace Home\Tool;

abstract class ACartTool
{

    /**
     * 向购物车添加1个商品
     * @param int $goods_id   商品id
     * @param string $goods_name 商品名
     * @param float $shop_price 价格
     * @return boolean
     */
    abstract public function add($goods_id, $goods_name, $shop_price);

    //减少1个商品数量, 如果数量为0, 则从购物车删除此商品
    abstract public function decr($goods_id);

    //删除商品
    abstract public function del($goods_id);

    //列出购物车所有的商品
    abstract public function items();

    //返回购物车有几种商品
    abstract public function calcType();

    //返回商品的个数
    abstract public function calcCnt();

    abstract public function calcMoney();

    abstract public function clear();
}

//单例模式, 禁止__construct和__clone, 只允许运行静态方法getIns获得单例对象
class CartTool extends ACartTool
{
    public static $ins = null;
    public $items      = array();

    final protected function __construct()
    {
        if (session('?cart')) {
            $this->items = session('cart');
        }
    }

    public static function getIns()
    {
        if (SELF::$ins === null) {
            self::$ins = new self();
        }
        return self::$ins;
    }

    //如果已经存在就+1
    public function add($goods_id, $goods_name, $shop_price, $goods_qty = '')
    {
        if (isset($this->items[$goods_id])) {
            if (!$goods_qty) {
                $this->items[$goods_id]['num'] += 1;
            } else {
                $this->items[$goods_id]['num'] += $goods_qty;
            }

        } else {
            if (!$goods_qty) {
                $qty = 1;
            } else {
                $qty = $goods_qty;
            }
            $goods                  = array('goods_name' => $goods_name, 'shop_price' => $shop_price, 'num' => $qty);
            $this->items[$goods_id] = $goods;
        }
    }

    public function decr($goods_id)
    {
        if (isset($this->items[$goods_id])) {
            $this->items[$goods_id]['num'] -= 1;
        }
        if ($this->items[$goods_id]['num'] < 1) {
            $this->del($goods_id);
        }
    }

    public function del($goods_id)
    {
        unset($this->items['goods_id']);
    }

    public function items()
    {
        return $this->items;
    }

    public function calcCnt()
    {
        $cnt = 0;
        foreach ($this->items as $v) {
            $cnt += $v['num'];
        }
        return $cnt;
    }

    public function calcType()
    {
        return count($this->items);
    }

    public function calcMoney()
    {
        $money = 0;
        // foreach ($this->items as $key => $value) {
        //     $money += ($value['shop_price'] * $value['num']);
        // }
        // 闭包(未测试)
        $callback = function ($arr, $goods_id) use (&$money) {
            $money += $arr['shop_price'] * $arr['num'];
        };
        array_walk($this->items, $callback);
        return $money;
    }

    public function clear()
    {
        $this->items = array();
        session('cart', null);
    }

    public function __destruct()
    {
        session('cart', $this->items);
    }
}
