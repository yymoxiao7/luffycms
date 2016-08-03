<?php
namespace app\admin\model;

use \think\Config;
use \think\Db;
use \think\Model;
use \think\Session;

class LogRecode extends Model
{
   
   
   public function login_record($remark,$name){
		
		$db_mg					=	Db::connect('MG_DB');
		
		$data['remark']			=	$remark;
		$data['user_id']		=	$name;
		$data['create_time']	=	date('Y-m-d H:i:s',time());
		$data['ip']				=	\app\common\tools\Visitor::getIP();
		
		$db_mg->table('user_log_remark')->insert($data);
		
		
		
	}
   
    
}
