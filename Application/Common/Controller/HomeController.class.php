<?php
namespace Common\Controller;

use Common\Controller\BaseController;

class HomeController extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();
        $menu      = D('HomeMenu');
        $name      = mb_strtolower(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME);
        $id        = $menu->where("name='$name'")->find()['id'];
        $breadmenu = $menu->getFamily($menu->select(), $id);
        if ($breadmenu) {
            $this->assign('breadmenu', $breadmenu);
        }

        //var_dump($breadmenu);
        $this->assign('goodcates', $this->exGoodCates());
    }

    protected function exGoodCates($cid = '0')
    {
        $cats_model = D('GoodCategory');

        $cate_list = S('goodcates' . $cid);
        if (!$cate_list) {
            $cate_list = $cats_model->getCatTree($cats_model->select(), $cid);
            S('goodcates' . $cid, $cate_list, 1);
        }
        if ($cid) {
            $info = $cats_model->find($cid);
            array_unshift($cate_list, $info); //getCatTree 不会包括本身
        }

        // $_cid = -1;
        // foreach ($cate_list as $key => $value) {
        //     $cate_list[$key]['hvson'] = false;

        //     if ($value['pid'] == $_cid) {
        //         $cate_list[$key - 1]['hvson'] = true;
        //     }
        //     $_cid = $value['id'];
        // }

        return $cate_list;
    }

    // protected function exBread($cid)
    // {
    //     $cats_model = D('GoodCategory');
    //     $bread_list = S('bread' . $cid);
    //     if (empty($bread_list)) {
    //         $bread_list = $cats_model->getFamily($cats_model->select(), $cid);
    //         S('bread' . $cid, $bread_list, 1);
    //     }

    //     return $bread_list;
    // }
}
