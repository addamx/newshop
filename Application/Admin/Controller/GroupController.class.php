<?php
namespace Admin\Controller;

use Common\Controller\AdminController;

class GroupController extends AdminController
{
    public function Index()
    {
        $groupModel = D('AuthGroup');
        $group_list = $groupModel->where('status=1')->select();

        foreach ($group_list as &$v) {
            $v['rules'] = $groupModel->getRules($v['id']);
        }
        //var_dump($group_list);exit;

        $this->assign('group_list', $group_list);
        $this->display();
    }

    public function modify($id)
    {
        $rule_list = D('AuthRule')->where('status=1')->select();

        $groupModel = D('AuthGroup');
        $group      = $groupModel->where('status=1')->find($id);
        $this->assign('rule_list', $rule_list);
        $this->assign('group', $group);
        $this->display();

    }

    public function ajaxModify()
    {
        //Ajax返回结果
        if (!empty($_POST)) {
            $_POST['rules'] = implode(',', $_POST['rules']);
            $groupModel     = D('AuthGroup');

            $rst = array();
            if (!$groupModel->create()) {
                $info          = implode(', ', $groupModel->getError());
                $rst['result'] = false;
                $rst['info']   = $info;

            } else {
                $state = $groupModel->save();
                if ($state) {
                    $rst['result'] = true;
                    $rst['info']   = '修改成功';
                } else if ($state === 0) {
                    $rst['result'] = false;
                    $rst['info']   = '没有任何修改';
                } else if ($state === false) {
                    $rst['result'] = false;
                    $rst['info']   = '修改失败';
                }
            }
            echo $this->ajaxreturn($rst);
        }

    }

    public function add()
    {
        if (!empty($_POST)) {
            $_POST['rules'] = implode(',', $_POST['rules']);
            $groupModel     = D('AuthGroup');
            if (!$groupModel->create()) {
                $this->exError($groupModel->getError(), '', 5);
            } elseif (!$groupModel->add()) {
                $this->error('添加角色失败', '', 5);
            } else {
                $this->success('添加角色成功', U('Index'), 5);
            }
            //$this->success();
        } else {
            $rule_list = D('AuthRule')->where('status=1')->select();
            $this->assign('rule_list', $rule_list);
            $this->display();
        }

    }

    public function del($id = '')
    {
        if ($id != '') {
            $groupModel = D('AuthGroup');
            //1. 删除管理员(status改为0)
            if ($groupModel->where('id=' . $id)->save(array('status' => '0'))) {
                $sql = M('auth_group_access')->where('group_id=' . $id);
                //2. 查询对应管理员是否存在
                if ($sql->find()) {
                    //3. 删除角色, 直接冲Database中删除
                    if (!$sql->delete()) {
                        $this->error("删除角色成功, 但在分配表删除失败", '', 3);
                    } else {
                        $this->success("删除角色及其分配成功", '', 3);
                    }
                } else {
                    $this->success("删除角色, 分配表对应的管理员不存在", '', 3);
                }
            } else {
                //$this->ajaxreturn('fail');
                $this->error("删除失败", '', 3);
            }
        }
    }

    public function recover()
    {

    }
}
