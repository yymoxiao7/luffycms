<?php
namespace app\admin\model;

use \think\Db;
use \think\Model;

class User extends Model
{
    protected $autoTimeField = ['password'];

    protected $dateFormat = 'Y-m-d';
    protected $type       = [
        'id'       => 'integer',
        'role_id'  => 'integer',
        'status'   => 'integer',
        'sex'      => 'integer',
        'birthday' => 'datetime',
    ];

    /**
     * 用户登录
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-10T11:31:15+0800
     * @params    array                   $value = array(
     *                                                'email'=>'',
     *                                                'password'=> ''
     *                                             ) [description]
     * @return   [type]                          [description]
     */
    public function login(array $params)
    {
        $userRow = Db::table('user')->field([
            'id', 'name', 'role_id', 'status', 'password', 'sex', 'birthday', 'tel', 'email',
        ])->where('email', $params['email'])->find();

        if (empty($userRow) || $userRow['status'] == 0 || $userRow['password'] != $this->setPasswordAttr($params['password'])) {

            if (empty($userRow)) {
                $this->error = '用户名/邮箱不存在！';
            } else if ($userRow['status'] == 0) {
                $this->error = '该用户已被禁用，请联系管理员。';
            } else if ($userRow['password'] != $this->setPasswordAttr($params['password'])) {
                $this->error = '密码错误！';
            }

            //登录失败要记录在日志里
            $loginErrorLog = \think\Loader::model('LoginErrorLog');
            $loginErrorLog->save([
                'email'    => $params['password'],
                'password' => $params['password'],
                'remark'   => $this->error,
            ]);

            return false;
        }

        unset($userRow['password']);

        \Think\Session::set(\Think\Config::get('login_session_identifier'), $userRow);

        //登录成功要记录在日志里
        $loginSuccessLog = \think\Loader::model('LoginSuccessLog');
        $loginSuccessLog->save([
            'user_id' => $userRow['id'],
        ]);

        return $userRow;
    }

    /**
     * 获取状态
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-19T16:00:40+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function getStatusAttr($value)
    {
        $status = [0 => '禁用', 1 => '启用'];
        return $status[$value];
    }

    /**
     * 获取性别
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-19T16:00:40+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function getSexAttr($value)
    {
        $status = [0 => '保密', 1 => '男', 2 => '女'];
        return $status[$value];
    }

    /**
     * 设置密码
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-19T15:58:11+0800
     * @param    [type]                   $value [description]
     */
    protected function setPasswordAttr($password)
    {
        return md5($password);
    }

}
