<?php
namespace Admin\Model;

use Common\Model\BaseModel;

class ManagerModel extends BaseModel
{
    protected $_link = array(
            'Group'=>array(
                    'mapping_type'      =>  self::MANY_TO_MANY,
                    'class_name'        =>  'AuthGroup',
                    //'mapping_name'      =>  'groups',
                    'foreign_key'       =>  'uid',
                    'relation_foreign_key'  =>  'group_id',
                    'relation_table'    =>  'newshop_auth_group_access', //此处应显式定义中间表名称，且不能使用C函数读取表前缀
                ),
        );

    protected $tableName = 'mg_users'; //当表名和当前的模型类的名称不同的时候需要定义。
    //验证时间: 1=>insert时, 2=>update时, 3=>所有情况(默认)
    protected $_salt = '';
    protected $_auto = array(
        array('status', '1'),
        
        array('password', '_md5', 3, 'callback'), //新增或者编辑时都要md5处理
        array('password', '', 2, 'ignore'), //表示密码留空则忽略, 用于修改用户资料时候密码的输入
        
        array('salt', 'ifSalt',3,'callback'),
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
            if ($info['password'] !== md5($pwd.$info['salt'])) {
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
        return md5($data.$this->exSalt());
    }

    //从属_md5()
    protected function exSalt() {
        $str ='asdfjlaskjf09[uuqtoi*&^*43hq5kja9430597(*&)]';
        $this->_salt = substr(str_shuffle($str), 0,8);
        return $this->_salt;
    }

    protected function ifSalt() {
        return $this->_salt;    //$this->_salt为''说明没有对pwd进行过md5(和exSalt())
    }

    /**
     * 获得管理员和他的角色
     * 注意 AND newshop_auth_group.status=1
     *
     * @param  boolean $limit false:默认获得全部管理员uid, 即使他们还没有分配角色;true:只获得有分配了角色的管理员uid
     * @param  string  $id    单独获得一个管理员的group资料, $limit不会影响输出, 不存在uid只返回null, 不存在gid就为null
     * @return mixed         field(uid,username,group_id,title)
     * 如果默认没有id, 返回二维数组; 有uid且有效就返回一维数组(没分配则gid和title为null), uid无效则只返回null
     */
    public function getGroup($limit = false, $uid = '')
    {
        if ($id == '') {
            if (!$limit) {
                //LEFT JOIN
                return $this
                    ->join('LEFT JOIN newshop_auth_group_access on newshop_mg_users.id = newshop_auth_group_access.uid')
                    ->join('LEFT JOIN newshop_auth_group on newshop_auth_group_access.group_id=newshop_auth_group.id AND newshop_auth_group.status=1')

                    ->field('newshop_mg_users.id as uid,newshop_mg_users.username,newshop_auth_group.id as group_id,newshop_auth_group.title')
                    ->select();
            } else {
                //JOIN
                return $this
                    ->join('JOIN newshop_auth_group_access on newshop_mg_users.id = newshop_auth_group_access.uid')
                    ->join('JOIN newshop_auth_group on newshop_auth_group_access.group_id=newshop_auth_group.id AND newshop_auth_group.status=1')
                    ->field('newshop_mg_users.id as uid,newshop_mg_users.username,newshop_auth_group.id as group_id,newshop_auth_group.title')
                    ->select();
            }
        } else {
            //LEFT JOIN
            return $this
                ->join('LEFT JOIN newshop_auth_group_access on newshop_mg_users.id = newshop_auth_group_access.uid')
                ->join('LEFT JOIN newshop_auth_group on newshop_auth_group_access.group_id=newshop_auth_group.id AND newshop_auth_group.status=1')
                ->where("newshop_mg_users.id=" . $uid)
                ->field('newshop_mg_users.id as uid,newshop_mg_users.username,newshop_auth_group.id as group_id,newshop_auth_group.title')
                ->find();

        }
    }

}
