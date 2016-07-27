<?php
namespace Admin\Controller;

use Common\Controller\AdminController;

class IndexController extends AdminController
{
    public function index()
    {
        $authRuleModel = D('AuthRule');
        $arr           = $this->authList;
        $nav           = $authRuleModel->getCatTree($arr);
        $this->assign('nav', $nav);
        $this->display();
    }

    public function welcome()
    {
        $this->display();
    }
}
