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

    protected $type = [
        'id'          => 'integer',
        'role_id'     => 'integer',
        'status'      => 'integer',
        'sex'         => 'integer',
        'update_time' => 'timestamp',
        'create_time' => 'timestamp',
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
		
        /*$userRow = Db::table('user')->field([
            'id', 'name', 'role_id', 'status', 'password', 'sex', 'birthday', 'tel', 'email',
        ])->where('email', $params['email'])->find();*/
		
		$db_mg				=	Db::connect('MG_DB');
		
		$where['account']	=	$params['nickname'];
		
		$userRow			=	$db_mg->table('mg_user')->field('id,nickname,role_id,password,email,status,create_time')->where($where)->find();
		
		$password			=	$this->getpassword_HT($params['password'],$userRow['create_time']);
		
		
		
        if (empty($userRow) || $userRow['status'] == 0 || $userRow['password'] != $password) {

            if (empty($userRow)) {
                $this->error = '用户名不存在！';
            } elseif ($userRow['status'] == 0) {
                $this->error = '该用户已被禁用，请联系管理员。';
            } elseif ($userRow['password'] != $password) {
                $this->error = '密码错误，请重新输入密码';
            }

            //登录失败要记录在日志里
           // Loader::model('BackstageLog')->record("登录失败,nickname:[{$params['nickname']}] password:[" . Strings::replaceToStar($params['password']) . ']');
			
			Loader::model('LogRecode')->login_record("登录失败,nickname:[{$params['nickname']}] password:[" . Strings::replaceToStar($params['password']) . ']','');
		   
		   
            return false;
        }

        unset($userRow['password']);

        Session::set(Config::get('login_session_identifier'), $userRow);

        //登录成功要记录在日志里
        //Loader::model('BackstageLog')->login_record('登陆成功');
		$name	=	$userRow['nickname'];
		Loader::model('LogRecode')->login_record('登陆成功',$name);
		
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
	
	/* 获取string这个工具类里面的原来的后台密码
	 * @author 	 ywq
     * @dateTime 2016年8月1日14:37:41
     * @param  	 $password,$time
	 */
	protected function  getpassword_HT($password,$time){
		
		
		 return Strings::get_HT_password($password,$time);
		
	}
	
	
	
    /**
     * [setBirthdayAttr description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-24T14:00:15+0800
     * @type     {{type}}
     * @param    [type]                   $birthday [description]
     * @param    array                    $data     [description]
     */
	 
	
	 
    protected function setBirthdayAttr($birthday, $data = array())
    {
        if ($birthday == '') {
            return "1970-01-01";
        }
        return $birthday;
    }

}
