<?php
namespace Common\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
        //echo '<p>' . T() . '</p>';    //如果在html的DOCTYPE声明前输出, 会使DOCTYPE失效并且无法显示frameset标签
    }

    public function verifyImg()
    {
        $config = array(

            //'useZh'    => true, // 使用中文验证码
            'fontSize' => 14, // 验证码字体大小(px)
            'useCurve' => false, // 是否画混淆曲线
            'useNoise' => false, // 是否添加杂点
            'imageH'   => 30, // 验证码图片高度
            'imageW'   => 100, // 验证码图片宽度
            'length'   => 4, // 验证码位数
        );
        $verify = new \Think\Verify($config);
        $verify->entry();
    }

    /**
     * AJAX: 登录界面提前通过ajax提前验证验证码
     * @param  str $capcha ajax传来的验证
     * @return str         显示是否成功.
     */
    public function checkCaptcha($data = '')
    {
        $config = array('reset' => false); //禁止验证后重置
        $verify = new \Think\Verify($config);
        if (!$verify->check($data)) {
            $this->ajaxreturn("fail");
        } else {
            $this->ajaxreturn("success");
        }
    }

    //根据错误信息是一个字符还是一个数组做页面显示
    public function exError($error, $url, $time)
    {
        is_array($error) ? $this->error(implode('<br/>', $error), $url, $time) : $this->error($error, $url, $time);
    }
}
