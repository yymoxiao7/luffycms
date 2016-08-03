<?php
namespace app\admin\model;

use \think\Config;
use \think\Model;
use \think\Session;

class BackstageLog extends Model
{
    protected $updateTime = false;
    protected $insert     = ['ip', 'user_id'];
    protected $type       = [
        'create_time' => 'timestamp',
    ];

    /**
     * 设置登录用户的ip
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T10:33:05+0800
     * @param    [type]                   $ip [description]
     */
    protected function setIpAttr()
    {
        return \app\common\tools\Visitor::getIP();
    }

    /**
     * [setUserId description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T14:27:19+0800
     * @param    string                   $value [description]
     */
    protected function setUserIdAttr()
    {
        $user_id = 0;
        if (Session::has(Config::get('login_session_identifier')) !== false) {
            $user_id = Session::get(Config::get('login_session_identifier') . '.id');
        }
        return $user_id;
    }

    /**
     * [record description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T14:25:32+0800
     * @param    [type]                   $remark [description]
     * @return   [type]                           [description]
     */
    public function record($remark)
    {
        //$this->save(['remark' => $remark]);
		//Db::table('backstage_log')->save("remark={$remark}");
		/*$db_mg					=	Db::connect('MG_DB');
		
		$data['remark']			=	$remark;
		$data['user_id']		=	$this->userRow['id'];
		$data['create_time']	=	time();
		$data['ip']				=	$this->setIpAttr();
		$ret					=	$db_mg->table('user_log_remark')->insert(['id' => 18, 'remark' => 'thinkphp']);
		$db_mg->query("INSERT INTO user_log_remark (user_id, remark ) VALUES (344,'success')");*/
		
		$db_mg					=	Db::connect('MG_DB');
		
		$data['remark']			=	$remark;
		$data['user_id']		=	$this->userRow['nickname'];
		
		$data['create_time']	=	date('Y-m-d H:i:s',time());
		$data['ip']				=	$this->setIpAttr();
		
		$db_mg->table('user_log_remark')->insert($data);
		
		
    }
	
	public function login_record($remark){
		
		$db_mg					=	Db::connect('MG_DB');
		
		$data['remark']			=	$remark;
		$data['user_id']		=	$this->userRow['nickname'];
		$data['create_time']	=	date('Y-m-d H:i:s',time());
		$data['ip']				=	\app\common\tools\Visitor::getIP();
		
		$db_mg->table('user_log_remark')->insert($data);
		
		
		
	}
}
