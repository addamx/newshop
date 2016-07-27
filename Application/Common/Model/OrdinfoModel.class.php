<?php
namespace Common\Model;

use Common\Model\BaseModel;

class OrdinfoModel extends BaseModel
{

    protected $_link = array(
        'ordergoods' => array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'Ordergoods',
            'foreign_key'   => 'userId',
            'condition'     => 'is_delete = 0',
            'mapping_order' => 'ordtime desc',
        ),
    );

    protected $_auto = array(
        array('ord_sn', 'getSn', 1, 'callback'),
        array('ordtime', 'time', 1, 'function'),
    );

    public function getSn()
    {
        $sn = 'OD' . date('Ymd') . mt_rand(10000, 99999);
        if ($this->where("ord_sn='$sn'")->find()) {
            $sn = $this->getSn();
        }
        return $sn;
    }
}
