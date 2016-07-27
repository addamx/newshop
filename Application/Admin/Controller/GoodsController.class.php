<?php
namespace Admin\Controller;

use Common\Controller\AdminController;

class GoodsController extends AdminController
{
    public function index($p = '1', $cat = '0')
    {
        $good_model = D('Goods');
        $catsModel  = D('GoodCategory');

        $sql      = $good_model->order('add_time desc')->page($p . ',5');
        $cat_sons = $catsModel->getCatTree($catsModel->select(), $cat);
        foreach ($cat_sons as $value) {
            $cats_str .= $value['id'] . ',';
        }
        $list = $sql->where('is_delete=0 AND cat_id in(' . $cats_str . $cat . ')')->select();

        $this->assign('list', $list); // 赋值数据集
        $count = $good_model->count(); // 查询满足要求的总记录数
        $Page  = new \Think\Page($count, 5); // 实例化分页类 传入总记录数和每页显示的记录数
        $show  = $Page->show(); // 分页显示输出
        $this->assign('page', $show); // 赋值分页输出

        $cats = $catsModel->getCatTree($catsModel->select());
        $this->assign('cats', $cats);
        $this->assign('cat', $cat); //GET:cat_id

        $this->display(); // 输出模板

    }

    public function add()
    {
        if (IS_POST) {
            if (!empty($_FILES)) {
                if (!empty($error = $this->upImg('ori_img'))) {
                    $this->error($error, '', 5);
                }
            }

            $_POST['weight'] = $_POST['weight'] * $_POST['weight_unit'];
            $good_model      = D('Goods');
            if (!$good_model->create()) {
                $this->delImg($_POST['ori_img'], $_POST['goods_img'], $_POST['thumb_img']);
                $this->exError($good_model->getError(), '', 5);
                exit;
            } elseif (!$good_model->add()) {
                $this->delImg($_POST['ori_img'], $_POST['goods_img'], $_POST['thumb_img']);
                $this->error('添加商品失败', '', 10);
                exit;
            } else {
                $this->success('添加商品成功', '', 10);
            }
        } else {
            $catsModel = D('GoodCategory');
            $categorys = S('goodcates');
            if (!$categorys) {
                $categorys = $catsModel->getCatTree($catsModel->select());
                S('goodcates', $categorys, 60);
            }

            $this->assign('categorys', $categorys);
            $this->display();
        }

    }

    public function edit($id = '')
    {
        if ($id == '') {
            exit;
        }
        $good_model = D('Goods');
        if (IS_POST) {

            if (!empty($_FILES)) {
                if (($error = $this->upImg('ori_img') == true)) {
                    $this->error($error, '', 5);
                }

            }

            $_POST['weight'] = $_POST['weight'] * $_POST['weight_unit'];
            if (!$good_model->create()) {
                $this->exError($good_model->getError(), '', 5);
            } elseif (!$good_model->save()) {
                $this->error('修改商品失败', '', 10);
            } else {
                $this->success('修改商品成功', '', 10);
            }
        } else {
            $info = $good_model->where('is_delete=0 AND id=' . $id)->find();
            if (!$info) {
                exit('ID无效');
            }
            $info['goods_desc'] = htmlspecialchars_decode($info['goods_desc']);
            $catsModel          = D('GoodCategory');
            $categorys          = $catsModel->getCatTree($catsModel->select());
            $this->assign('categorys', $categorys);
            $this->assign('info', $info);
            $this->display();
        }

    }

    public function ajaxdel($id = '')
    {
        if ($id == '') {
            exit;
        }
        $goods_model       = D('Goods');
        $data['is_delete'] = '1';
        $info              = array();
        if (!$goods_model->find($id)) {
            $this->ajaxreturn(array('result' => false, 'info' => 'id无效'));
        }

        if (!$goods_model->where('id=' . $id)->save($data)) {
            $this->ajaxreturn(array('result' => false, 'info' => '删除商品失败'));
        } else {
            $this->ajaxreturn(array('result' => true, 'info' => '删除商品成功'));
        }

    }

    /**
     * [upOpImg description]
     * @param  [type] $name 上传图片的HTML name值
     * @return [type]       [description]
     */
    protected function upImg()
    {
        $config = array(
            'rootPath' => UPLOAD_PATH, //根目录
            'savePath' => 'good/', //保存路径
        );
        //附件被上传到路径：根目录/保存目录路径/创建日期目录
        $upload = new \Think\Upload($config);
        //uploadOne会返回已经上传的附件信息
        $rst = $upload->upload();
        if (!$rst) {
            return $upload->getError(); //返回上传附件产生的错误信息(string)
        } else {
            foreach ($rst as $rs) {
                //拼装图片的路径名
                $ori_img            = $rs['savepath'] . $rs['savename'];
                $_POST['ori_img'][] = $ori_img;

                //把已经上传好的图片制作缩略图Image.class.php
                $image = new \Think\Image();
                //open();打开图像资源，通过路径名找到图像
                $srcimg = $upload->rootPath . $ori_img;
                $image->open($srcimg);

                //生成goods_img, 加水印
                $image->thumb(300, 400);
                $image->water($upload->rootPath . '/watermark.jpg', $image::IMAGE_WATER_SOUTHEAST, 60);
                $goods_img = $rs['savepath'] . "goods_" . $rs['savename'];
                $image->save($upload->rootPath . $goods_img);
                $_POST['goods_img'][] = $goods_img;
                //生成thumb_img, 不加水印
                $image->open($srcimg); //重新打开句柄, 避免继续操作goods_img
                $image->thumb(80, 100);
                $thumb_img = $rs['savepath'] . "thumb_" . $rs['savename'];
                $image->save($upload->rootPath . $thumb_img);
                $_POST['thumb_img'][] = $thumb_img;
            }
            $_POST['ori_img']   = implode(',', $_POST['ori_img']);
            $_POST['goods_img'] = implode(',', $_POST['goods_img']);
            $_POST['thumb_img'] = implode(',', $_POST['thumb_img']);
            return '';
        }
    }

    protected function delImg(...$files)
    {
        $x_files = explode(',', implode(',', $files));
        foreach ($x_files as $f) {
            unlink(UPLOAD_PATH . $f);
        }
    }
}
