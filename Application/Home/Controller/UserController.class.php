<?php
namespace Home\Controller;

use Common\Controller\HomeController;

class UserController extends HomeController
{
    public function index()
    {
        if (!session('?user')) {
            $this->redirect('User/login', '', 1, '请先登录, 页面跳转中...');
            exit;
        }
        $user       = session('user');
        $user_model = D('Users');
        $user_order = $user_model->relation('Ordinfo')->find($user['id']);

        $this->assign('list', $user_order['Ordinfo']);

        $this->display();
    }

    public function history()
    {
        //session('his', null);
        var_dump(session('his'));
    }

    public function register()
    {
        if (IS_POST) {
            $post = I('post.');
            var_dump($post);
            $user_model = D('Users');
            if (!$user_model->create()) {
                $this->exError($user_model->getError(), '', 10);
            } else {
                if (($uid = $user_model->add()) == false) {
                    $this->Error('注册失败 (未知原因)', '', 5);
                } else {
                    $user = array('id' => $uid, 'name' => $post['username']);
                    session('user', $user);
                    $this->redirect('index', '', 3, '注册成功');
                }

            }
        }
        $this->display();
    }

    public function login()
    {
        if (session('?user')) {
            $this->redirect('', '', 2, '已登录, 请先注销');
            exit;
        }
        if (IS_POST) {
            $post       = I('post.');
            $user_model = D('Users');
            $info       = $user_model->checkNamePwd($post['username'], $post['password']);
            if (!$info) {
                $this->error('用户密码错误', '', 3);
                exit;
            }
            session('user', array('id' => $info['id'], 'name' => $info['username']));
            $this->success('登录成功', U('index'), 3);
            exit;
        }
        $this->display();

    }

    public function logout()
    {
        session('user', null);
        $this->redirect('Index/index', '', 1, '已退出登录');
    }
}
