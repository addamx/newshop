<?php
namespace Admin\Model;

use Common\Model\BaseModel;

class AuthGroupModel extends BaseModel
{
    protected $tableName = 'auth_group';

    //return 二维数组array(array('id':1, 'name':'admin/index/index/', 'title':'管理首页'), array(.....),...)
    // 注意 AND auth_rule.status=1 和 auth_group.status=1
    public function getRules($id)
    {
        $rules = $this->where('id=' . $id)->find()['rules']; // str "1,2,3,13.."
        return M('auth_rule')->where('status=1 AND id in (' . $rules . ')')->select();

    }
}
