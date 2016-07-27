<?php
namespace Admin\Controller;

use Common\Controller\AdminController;

class CategorysController extends AdminController
{
    public function index()
    {
        $catsModel = D('GoodCategory');
        $cats      = $catsModel->getCatTree($catsModel->select());
        $this->assign('cats', $cats);
        $this->display();
    }

    public function add()
    {
        $categoryModel = D('GoodCategory'); //在本模块找不到会到Common找
        if (!empty($_POST)) {
            if (!$categoryModel->create()) {
                $this->exError($categoryModel->getError(), '', 5);
            } elseif (!$categoryModel->add()) {
                $this->error('添加栏目失败', '', 5);
            } else {
                $this->success('添加栏目成功', '', 5);
            }
        } else {
            $categorys = $categoryModel->getCatTree($categoryModel->select());
            $this->assign('categorys', $categorys);
            $this->display();
        }
    }

    public function edit($id = '')
    {
        $id == '' ? exit : '';
        $categoryModel = D('GoodCategory');
        if (!empty($_POST)) {
            if (!$categoryModel->create()) {
                $this->exError($categoryModel->getError(), '', 5);
            } elseif (!$categoryModel->save()) {
                $this->error('修改栏目失败', '', 5);
            } else {
                $this->success('修改栏目成功', U('index'), 5);
            }
        } else {

            $categorys = $categoryModel->getCatTree($categoryModel->select());
            $info      = $categoryModel->find($id);

            $this->assign('info', $info);
            $this->assign('categorys', $categorys);
            $this->display();
        }
    }

    public function del($id = '')
    {
        $id == '' ? exit : '';
        $categoryModel = D('GoodCategory');
        $ifsons        = $categoryModel->ifHvsons($categoryModel->select(), $id);
        if ($ifsons) {
            $this->error('该栏目还有子孙栏目, 不能删除', '', 5);
        } else {
            $state = $categoryModel->where('id=' . $id)->delete();
            if ($state === 0) {
                $this->error('数据库不存在该id', U('index'), 5);
            } else if ($state === false) {
                $this->error('SQL语句出错', U('index'), 5);
            } else {
                $this->success('删除成功', U('index'), 5);
            }
        }
    }
}
