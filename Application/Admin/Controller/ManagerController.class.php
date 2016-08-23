<?php
namespace Admin\Controller;

use Common\Controller\AdminController;

class ManagerController extends AdminController
{
    public function Index()
    {
        $mg   = D('Manager');
        $list = $mg->getList('1', false);
        $this->assign('list', $list);
        $this->display();
    }

    public function login()
    {
        $this->assign('info', '');
        if (IS_POST) {
            $verify = new \Think\Verify();
            if (!$verify->check($_POST['captcha'])) {
                $this->assign('info', '验证码错误');
            } else {
                $mg_users = D('Manager');

                if (!$mg_users->create($_POST, 4)) {
                    //所有情况(3)和情况4都会进行验证
                    $this->exError($mg_users->getError(), U('login'), 5);
                }
                $result = $mg_users->checkNamePwd($_POST['username'], $_POST['password']);

                if ($result == false) {
                    $this->error('账号密码有误, 请重新登录', U('login'));
                } else {
                    session('mg_user', $result);
                    $this->redirect('Index/index');
                }

            }
        }
        if (session("?mg_user")) {
            $this->redirect('Index/index', '', 1, '已登录');
        }
        $this->display();
    }

    public function logout()
    {
        session('mg_user', null);
        $this->redirect('login');
    }

    //由于在AdminController设置了设置了auth类节点验证, 以下_empty操作被取代;
    public function _empty()
    {
        $this->redirect('Index/Index', '', 2, '无效页面跳转中...'); // Manager/login, Admin/Manager/login也行
    }

    //增加管理员
    public function addmanager()
    {

        if (!empty($_POST)) {
            $mg = D('Manager');
            if (!$mg->create()) {
                $this->exError($mg->getError(), '', 10);
            } else if (!$mg->add()) {
                $this->error('添加管理员失败', '', 10);
            } else {
                $this->redirect('assignRole', '', 3, '添加管理员成功, 正转向角色分配');
            }
        }

        $this->display();
    }

    public function editManager($id = '')
    {
        $mg = D('Manager');
        if (!empty($_POST)) {
            $rules = array(array('captcha', 'require', '验证码必须！', 4));
            if (!$mg->create()) {
                $this->exError($mg->getError(), '', 5);
            } else {
                $state = $mg->save();
                if ($state === '0') {
                    $this->success('没有进行修改', U('Index'), 30);
                } else if ($state === false) {
                    $this->error('修改失败');
                } else {
                    $this->success('修改成功', U('Index'), 30);
                }

            }
        } else if ($id != '') {
            $info = $mg->getList('1', false, ' AND id=' . $id)[0];
            $this->assign('info', $info);
            $this->display();
        }
    }

    public function delManager($id = '')
    {
        if ($id != '') {
            $mg             = D('Manager');
            $data['status'] = 0;
            //1. 删除管理员(status改为0)
            if ($mg->where('id=' . $id)->save($data)) {
                $sql = M('auth_group_access')->where('uid=' . $id);
                //2. 查询角色是否存在
                if ($sql->find()) {
                    //3. 删除角色, 直接冲Database中删除
                    if (!$sql > delete()) {
                        $this->error("删除管理员成功, 但在分配表删除失败", '', 3);
                    } else {
                        $this->success("删除管理员及其分配成功", '', 3);
                    }
                } else {
                    $this->success("删除管理员成功, 分配表对应角色不存在", '', 3);
                }
            } else {
                //$this->ajaxreturn('fail');
                $this->error("删除失败", '', 3);
            }
        }
    }

    /**
     * 分配角色
     * @param  str $key 搜索关键词
     */
    public function assignRole($key = '')
    {
        $info = '';
        if ($key == '') {
            if (!empty($_POST)) {
                if (!empty($_POST['uid']) && !empty($_POST['group_id'])) {
                    $agc = M('auth_group_access');
                    $agc->create();
                    if ($agc->where('uid=' . $_POST['uid'])->find() === null) {
                        if ($agc->add()) {
                            $info = '成功分配了角色';
                        } else {
                            $info = '分配角色失败';
                        }

                    } else {
                        //没有主键不能用save();
                        if ($agc->where('uid=' . $_POST['uid'])->setField('group_id', $_POST['group_id'])) {
                            $info = '成功修改角色';
                        } else {
                            $info = '修改角色失败';
                        }

                    }

                } else {
                    $info = '请先选择管理员和角色';
                }
            }

        }
        $mg_group_list = D('Manager')->getGroup();
        $group_list    = D('AuthGroup')->where('status=1')->select();

        $this->assign('info', $info);
        $this->assign('mg_group_list', $mg_group_list);
        $this->assign('group_list', $group_list);
        $this->display();
    }

    public function recover()
    {

    }

}
