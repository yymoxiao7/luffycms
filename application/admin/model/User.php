<?php
namespace app\admin\model;

use \app\common\tools\Strings;
use \think\Config;
use \think\Db;
use \think\Loader;
use \think\Model;
use \think\Session;

class User extends Model
{
    protected $insert = ['password'];

    protected $dateFormat = 'Y-m-d';
    protected $type       = [
        'id'      => 'integer',
        'role_id' => 'integer',
        'status'  => 'integer',
        'sex'     => 'integer',
    ];

    public function role()
    {
        return $this->belongsTo('Role');
    }

    /**
     * 用户登录
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-10T11:31:15+0800
     * @params    array                   $value = array(
     *                                                'email'=>'',
     *                                                'password'=> ''
     *                                             ) [description]
     * @return [type] [description]
     */
    public function login(array $params)
    {
        $userRow = Db::table('user')->field([
            'id', 'name', 'role_id', 'status', 'password', 'sex', 'birthday', 'tel', 'email',
        ])->where('email', $params['email'])->find();

        if (empty($userRow) || $userRow['status'] == 0 || $userRow['password'] != $this->setPasswordAttr($params['password'])) {

            if (empty($userRow)) {
                $this->error = '用户名/邮箱不存在！';
            } elseif ($userRow['status'] == 0) {
                $this->error = '该用户已被禁用，请联系管理员。';
            } elseif ($userRow['password'] != $this->setPasswordAttr($params['password'])) {
                $this->error = '密码错误！';
            }

            //登录失败要记录在日志里
            Loader::model('BackstageLog')->record("登录失败,email:[{$params['email']}] password:[" . Strings::replaceToStar($params['password']) . ']');

            return false;
        }

        unset($userRow['password']);

        Session::set(Config::get('login_session_identifier'), $userRow);

        //登录成功要记录在日志里
        Loader::model('BackstageLog')->record('登录');

        return $userRow;
    }

    /**
     * [profileEdit description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-26T10:53:30+0800
     * @param  strings $value [description]
     * @return [type]  [description]
     */
    public function profileEdit(array $data)
    {
        if (isset($data['password']) && $data['password'] == '') {
            unset($data['password']);
        } else {
            $data['password'] = $this->setPasswordAttr($data['password']);
        }

        $pk = $this->getPk();
        if (!isset($data[$pk])) {
            $this->error = '参数不对！';

            return false;
        }

        $profile = $this->find($data[$pk]);
        if (isset($data['head']) && $profile['head'] != $data['head']) {
            $this->deleteHead($profile['head']);
        }

        return $this->profileEditField()->save($data, [$pk => $data[$pk]]);

    }

    /**
     * [userAdd description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T10:16:00+0800
     * @param  array  $data [description]
     * @return [type] [description]
     */
    public function userAdd(array $data)
    {
        return $this->userAddField()->save($data);
    }

    /**
     * [deleteUser description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T10:44:48+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function deleteUser($id)
    {
        $profile = $this->find($id);
        $this->deleteHead($profile['head']);

        return $profile->delete();
    }

    /**
     * [deleteHead description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T10:16:45+0800
     * @param  [type] $head [description]
     * @return [type] [description]
     */
    protected function deleteHead($head)
    {
        if ($head != '' && file_exists(($file = Strings::fileWebToServer($head)))) {
            unlink($file);
        }
    }

    /**
     * [userAddField description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T10:18:01+0800
     * @return [type] [description]
     */
    public function userAddField()
    {
        return $this->allowField(['name', 'email', 'password', 'status', 'sex', 'head', 'birthday', 'tel', 'role_id']);
    }

    /**
     * [profileEditField description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-26T17:36:24+0800
     * @return [type] [description]
     */
    protected function profileEditField()
    {
        return $this->allowField(['name', 'password', 'status', 'sex', 'head', 'birthday', 'tel', 'role_id']);
    }

    /**
     * 获取状态
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-19T16:00:40+0800
     * @param  strings $value [description]
     * @return [type]  [description]
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
     * @param  strings $value [description]
     * @return [type]  [description]
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
     * @param [type] $value [description]
     */
    protected function setPasswordAttr($password, $data = array())
    {
        return Strings::password($password);
    }

    protected function setBirthdayAttr($birthday, $data = array())
    {
        if ($birthday == '') {
            return "1970-01-01";
        }
    }

}
