<?php
namespace Common\Model;

use Common\Model\BaseModel;

class GoodsModel extends BaseModel
{
    //protected $_link = array('comment'=>self::HAS_MANY,);
    protected $_link = array(
        'Comment'=> array(
                'mapping_type'=>self::HAS_MANY,
                'class_name'=>'Comment',
                'foreign_key'   => 'goods_id',  //goods的主键作为外键在comment表的列名, 如果不加, 默认是 无前缀表名_id
                //'mapping_name'=>'comment',
            )
        );
    //限定插入或更新的字段, 多余的会在create()时被丢弃
    //protected $insertFields = array();
    //protected $updateFields = array();
    //在C中, 像这样限定字段也行, M('User')->field('account,password,nickname,email')->create();
    protected $_auto = array(
        array('add_time', 'time', 1, 'function'),
        array('last_update', 'time', 2, 'function'),
        array('sn', 'getSn', 1, 'callback'),
    );
    //验证条件(0:默认/存在就验证(适用新增和更新), 1:必须验证(只适用新增), 2:值非空时验证(适用非必要选项))
    //验证时间: 1=>insert时, 2=>update时, 3=>所有情况(默认)
    protected $_validate = array(
        array('name', 'require', '必须有商品名'),
        array('name', '', '商品名已经存在', 0, 'unique', 3),
        array('sn', '', '序号已经存在', 0, 'unique', 3),
        array('cat_id', 'number', '栏目id必须是整型值', 0, '', 3),
        array('shop_price', '/^(([1-9]\d*(\.\d{1,2})?)|(0\.\d{1,2}))$/', '售价为非法格式', 0, 'regex', 3),
        array('market_price', '/^(([1-9]\d*(\.\d{1,2})?)|(0\.\d{1,2}))$/', '市场价为非法格式', 0, 'regex', 3),
        array('is_new', array('0', '1'), 'is_new只能是0或1', 0, 'in', 3),
        array('is_hot', array('0', '1'), 'is_hot只能是0或1', 0, 'in', 3),
        array('is_best', array('0', '1'), 'is_best只能是0或1', 0, 'in', 3),
        array('is_on_sale', array('0', '1'), 'is_on_sale只能是0或1', 0, 'in', 3),
        array('brief', '10,100', '商品简介就在10到100字符', 0, 'length', 3),
        array('ori_img', 'require', '请上传图片', 1, '', 1),
    );

    public function getSn()
    {
        $sn = 'GD' . date('Ymd') . mt_rand(10000, 99999);
        if ($this->where("sn='$sn'")->find()) {
            $sn = $this->getSn();
        }
        return $sn;
    }

    public function getAll() {
        $condition['is_sale'] = 1;
        $condition['is_delete'] = 0;
        $condition['_logic'] = 'AND';
        return $goods = D('Goods')->where($condition)->select();
    }

    public function getOne($id) {
        $condition['is_sale'] = 1;
        $condition['is_delete'] = 0;
        $condition['_logic'] = 'AND';
        return $goods = D('Goods')->where($condition)->find($id);
    }
}
