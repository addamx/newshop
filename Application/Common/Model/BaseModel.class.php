<?php
namespace Common\Model;

use Think\Model\RelationModel;

class BaseModel extends RelationModel
{
    protected $patchValidate = true; //批量验证, getError()输出可能是一个字符或一个数组;

    /**
     * 递归, 获取"后代"树形结构的菜单,栏目//排序并加上lev字段
     * 注意: 不包含id=$parent_id自身, 只获得后代
     * @param  array  $arr       二维数组, 含有id和pid字段, (如菜单\栏目的表数据)
     * @param  integer $parent_id pid字段, lev为0是位顶级菜单
     * @param  integer $lev       层次
     * @return array            添加了lev的表数组
     */
    public function getCatTree($arr, $parent_id = 0, $lev = 0)
    {
        $tree = array();
        foreach ($arr as $v) {
            if ($v['pid'] == $parent_id) {
                $v['lev'] = $lev;
                $tree[]   = $v;

                $tree = array_merge($tree, $this->getCatTree($arr, $v['id'], $lev + 1));
            }
        }
        return $tree;
    }

    //检查是否$arr中是否有$id的子孙栏目
    public function ifHvsons($arr, $id)
    {
        foreach ($arr as $v) {
            if ($v['pid'] == $id) {
                return true;
            }
        }
        return false;
    }

    /**
     * [getFamily 获取上级栏目, 面包屑导航]
     * @param  [type] $arr [description]
     * @param  [type] $id  [description]
     * @return [type]      [description]
     */
    public function getFamily($arr, $id)
    {
        $fm = array();
        foreach ($arr as $v) {
            if ($v['id'] == $id) {
                $info = $v;
                break;
            }
        }
        $pid = $info['pid'];
        while ($pid > 0) {
            foreach ($arr as $v) {
                if ($v['id'] == $pid) {
                    $fm[] = $v;
                    $pid  = $v['pid']; //用父级id(>0时)再做foreach循环, 知道这个pid是0
                    break;
                }
            }
        }
        $fm   = array_reverse($fm);
        $fm[] = $info;
        return $fm;
    }
}
