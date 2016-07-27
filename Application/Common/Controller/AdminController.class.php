<?php
namespace Common\Controller;

use Common\Controller\BaseController;

class AdminController extends BaseController
{
    //登录前可以访问的ACTION
    protected $allow_action = array(
        'admin/manager/verifyimg',
        'admin/manager/login',
        'admin/manager/logout',
        'admin/manager/checkcapcha',
    );

    protected $authList = array(); //二维数组 菜单栏

    public function _initialize()
    {
        parent::_initialize();

        $rule_name = strtolower(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME);

        if (!in_array($rule_name, $this->allow_action)) {
            if (empty($_SESSION['mg_user'])) {
                $this->error('您还没有登录后台', U('Admin/Manager/Login'));
            }

            $auth   = new \Think\Auth();
            $result = $auth->check($rule_name, session('mg_user')['id']);
            if (!$result) {
                $this->error('您没有权限访问');
            }

            //通过验证, 记录二维数组的rules数据集
            $this->authList = $this->getAuthList(session('mg_user')['id']);

        }

    }

    /**
     * 返回可以访问且要显示的菜单
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    protected function getAuthList($uid)
    {
        $exAction = array(
            "admin/index/welcome",
            "admin/index/index",
            "admin/group/ajaxmodify",
            "admin/goods/ajaxdel",
            "admin/goods/edit",
            "admin/categorys/edit",
            "admin/categorys/del",
            "admin/group/del",
            "admin/group/del",
            "admin/group/modify",
            "admin/manager/editmanager",
            "admin/manager/delmanager",
        );

        $auth   = new \Think\Auth();
        $groups = $auth->getGroups($uid); //返回对应的角色资料;二维数组
        $rules  = ''; //收集所有的rules
        foreach ($groups as $g) {
            $rules .= $g['rules'];
        }

        $condition           = array();
        $condition['id']     = array('IN', $rules);
        $condition['name']   = array('NOT IN', $exAction);
        $condition['_logic'] = 'AND';

        return M('auth_rule')->where($condition)->select();
    }
}
