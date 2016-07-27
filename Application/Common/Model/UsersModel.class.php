<?php
namespace Common\Model;

use Common\Model\BaseModel;

class UsersModel extends BaseModel
{
    protected $_link = array(
        'Ordinfo' => array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'Ordinfo',
            'foreign_key'   => 'user_id',
            'condition'     => 'is_delete = 0',
            'mapping_order' => 'ordtime desc',
        ),
    );

    //验证时间: 1=>insert时, 2=>update时, 3=>所有情况(默认)
    protected $_salt = '';
    protected $_auto = array(
        array('status', '1'),

        array('password', '_md5', 3, 'callback'), //新增或者编辑时都要md5处理
        array('password', '', 2, 'ignore'), //表示密码留空则忽略, 用于修改用户资料时候密码的输入

        array('salt', 'ifSalt', 3, 'callback'),
        array('salt', '', 2, 'ignore'),

        array('register_time', 'time', 1, 'function'),
        array('last_login_ip', '', 1),
        array('last_login_time', 'time', 1, 'function'),
    );
    //验证条件(0:默认/存在就验证(适用新增和更新), 1:必须验证(只适用新增), 2:值非空时验证(适用非必要选项))
    //验证时间: 1=>insert时, 2=>update时, 3=>所有情况(默认) [可以自定义情况]

    protected $_validate = array(
        array('username', 'require', '用户名必须'),
        //array('username', '5,10', '用户名在5至10个字符内', 'length'),
        array('username', '/^[A-Za-z]\w{4,9}$/', '用户名必须为5至10个字符内且字母开头', 0, 'regex'),
        array('username', '', '帐号名称已经存在！', 0, 'unique', 1),
        array('repassword', 'password', '两次密码不正确', 0, 'confirm'),
        array('password', '/^\w{6,20}$/', '密码只能是6至20个数字或字母内', self::VALUE_VALIDATE, 'regex'),
        array('email', 'email', '邮箱格式不正确', 2),
        array('phone', '/^1[3|4|5|8]\d{9}$/', '手机号码错误！', 2, 'regex'),

        array('captcha', 'require', '验证码必须！', 4), // 只在登录时候验证$User->create($_POST,4)
        array('username', '/^[A-Za-z]\w{4,9}$/', '用户名必须为5至10个字符内且字母开头', 1, 'regex', 4), // 只在自定义4时间(登录)时候验证
        array('password', '/^\w{6,20}$/', '密码只能是6至20个数字或字母内', 1, 'regex', 4), // 只在自定义4时间(登录)时候验证

    );

    public function checkNamePwd($name, $pwd)
    {
        $info = $this->getByusername($name);
        if ($info != null) {
            if ($info['password'] !== md5($pwd . $info['salt'])) {
                echo 'xxxxx';
                return false;
            } else {
                return $info;
            }
        } else {
            return false;
        }
    }

    //
    public function getList($status, $pw = false, $where = '')
    {
        if ($pw == false) {
            return $this->where("status=" . $status . $where)->field('id, username, email, phone, register_time, last_login_ip, last_login_time')->select();
        } else {
            return $this->where("status=" . $status . $where)->select();
        }
    }

    protected function _md5($data)
    {
        if (!$data) {
            return '';
        }
        return md5($data . $this->exSalt());
    }

    //从属_md5()
    protected function exSalt()
    {
        $str         = 'asdfjlaskjf09[uuqtoi*&^*43hq5kja9430597(*&)]';
        $this->_salt = substr(str_shuffle($str), 0, 8);
        return $this->_salt;
    }

    protected function ifSalt()
    {
        return $this->_salt; //$this->_salt为''说明没有对pwd进行过md5(和exSalt())
    }
}
