<?php
  
  	 function getIPCityInfo($ip){
		$locFile 			=	'/home/swoole/lib/GEO/IPLocation.class.php';
		if(file_exists($locFile)){
			require_once $locFile;
			
			$IPLocation	=	new IPLocation();
			
			$ipLocationInfo					=	$IPLocation->getCountryArea($ip);
			if($ipLocationInfo && isset($ipLocationInfo['country'])){
				$info 	=	($ipLocationInfo['city']).'@'.$ipLocationInfo['region'].'@'.getCountryEn($ipLocationInfo['country']) ;
			}else{
				$info	=	json_encode($ipLocationInfo);
			}
		}else{
			$info	=	'no IPLocation Class';
		}
		return$info;
	}
	
   
function number_format_kilo($v,$dec=0){
	return	number_format($v/1000,$dec).'K';
}

	 
	  function getSessionLang(){
		$lang 	=	isset($_SESSION['lang_type']) ? $_SESSION['lang_type'] : 'en';
		return $lang ;
	}
	 
	function ML($str){
		import('@.ORG.multiLang'); 
		return multiLang::getText($str);
	}
	
	
	function parseLanguageList($languageList) {
		
		if (is_null($languageList)) {
			if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
				return array();
			}
			$languageList = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		}
		$languages = array();
		$languageRanges = explode(',', trim($languageList));
		foreach ($languageRanges as $languageRange) {
			if (preg_match('/(\*|[a-zA-Z0-9]{1,8}(?:-[a-zA-Z0-9]{1,8})*)(?:\s*;\s*q\s*=\s*(0(?:\.\d{0,3})|1(?:\.0{0,3})))?/', trim($languageRange), $match)) {
				if (!isset($match[2])) {
					$match[2] = '1.0';
				} else {
					$match[2] = (string) floatval($match[2]);
				}
				if (!isset($languages[$match[2]])) {
					$languages[$match[2]] = array();
				}
				$languages[$match[2]][] = strtolower($match[1]);
			}
		}
		krsort($languages);
		return $languages;
	}
	
	function get_browser_lang(){
		$lang 	=	get_client_lang();
		if($lang=='English'){
			return 'en';
		}
		return 'zh';
	}

	function get_cookie_lang(){
		$lang 	=	isset($_COOKIE['lang_type_ck'])?$_COOKIE['lang_type_ck']:'zh';
		 
		return $lang;
	}
	
	function get_client_lang(){
	
		if(empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
			return 'English';
		}
		$langtype	=	$_SERVER['HTTP_ACCEPT_LANGUAGE'];
		// $langtype	=	'fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4,it;q=0.2,ru;q=0.2,zh-CN;q=0.';
		$lang_arr 	=  parseLanguageList($langtype); 
		$lang 	=	array_shift($lang_arr);
		$lang	=	$lang[0];
		//ֻȡǰ4λ������ֻ�ж������ȵ����ԡ����ȡǰ5λ�����ܳ���en,zh�������Ӱ���жϡ�
		$langConf = array('es'=>'Spanish',
		'jp'=>'Japanese', 'zh'=>'Chinese_traditional','zh'=>'Chinese_simplified'
		,'id'=>'Indonesian','vn'=>'Vietnamese','nl'=>'Dutch',
		'ko'=>'Korean','fr'=>'French','pt'=>'Portuguese','de'=>'German','da'=>'Danish','ja'=>'Japanese',
		'ru'=>'Russian','tr'=>'Turkish','it'=>'Italian','th'=>'Thai', 'fi'=>'Finnish','gr'=>'Greek',
		'sv'=>'Swedish','en'=>'English','ar'=>'Arabic');

		foreach($langConf as $k=>$v){
			if (preg_match("/{$k}/i", $lang))
			{
				return $v;
			}
		} 
		return 'English'; 
	}
	
	function timeAgo($time,$postFix=''){
		$unix 	=	0;
		$now 	=	time();
		if(strpos($time,':')>0){
			$unix 	=	strtotime($time);
		}else{
			$unix 	=	$time;
		}

		$range 	=	['60'=>'s','3600'=>'m','86400'=>'h','8640000000'=>'d'];

		$diff 	=	$now 	-	$unix;

		$unit 	=	's';
		$num 	=	0;
		$lastUnit 	=	1;
		foreach($range as $key=>$val){

			if($diff<$key){
				$num 	=	number_format($diff/$lastUnit,1);
				$unit 	=	$val;
				break;
			}

			$lastUnit 	=	$key;

		}

		return $num.' '.$unit.$postFix;
	}

		function show($var,$title='')
		{
			defined ('SHOW') or define('SHOW',TRUE);
			if(SHOW){ 
			}
			else{
				return;
			} 
			static $i = 0;
			if(is_array($var))
			{
				echo "<pre>".$i." $title :  ";
				print_r($var);
				echo "</pre>";
			}
			else if(is_string($var))
			{
				echo "<pre>".$i." $title : ";
				echo ($var);
				echo "</pre>";
			}
			else
			{
				echo "<br > $title  $i:<br>";
				echo "<pre>";
				if($type=='DUMP')
					var_dump($var);
				echo "</pre>";
			}
			
			$i = $i + 1;
		}
		
		function diedump($a){
			dump($a);
			exit();
		}
	
		function isEmail($email){ 
			$email_regex	=	'/^[_.0-9a-z-+]+@([0-9a-z][0-9a-z-]*.)+[a-z]{2,4}$/i';
			if(!is_string($email) || 0==preg_match($email_regex,$email) ){
				return FALSE;
			}
			return TRUE;
		}
	
	 //��¼��־���ļ�
	 function record_log($dir='',$name,$content=""){
		 date_default_timezone_set('PRC');
		$filename= $dir.$name.'_'.date('y_m_d').'.log';
		Log::record(''.$content, Log::DEBUG);
		Log::save('', $filename);
		return $filename;
	}	

	 // ģ���ύ���ݺ���
	function vpost($url,$data,$cook=0,$header=0){
			static $curl = FALSE; 
			if($curl === FALSE){
				$curl = curl_init(); // ����һ��CURL�Ự
			}
			curl_setopt($curl, CURLOPT_URL,$url); // Ҫ���ʵĵ�ַ
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // ����֤֤����Դ�ļ��
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // ��֤���м��SSL�����㷨�Ƿ����
			curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // ģ���û�ʹ�õ������
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // ʹ���Զ���ת
			curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // �Զ�����Referer
			if(!empty($data)){
				curl_setopt($curl, CURLOPT_POST, 1); // ����һ�������Post����
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post�ύ�����ݰ�
			}
			curl_setopt($curl,CURLOPT_COOKIESESSION,0); 
			//if($cook ==  0)
			//	curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__).'/openfirecookie.txt'); //����
			//else if($cook == 1)
			//	curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__).'/openfirecookie.txt'); //��ȡ
				
			curl_setopt($curl, CURLOPT_TIMEOUT, 60); // ���ó�ʱ���Ʒ�ֹ��ѭ��
			curl_setopt($curl, CURLOPT_HEADER, $header); // ��ʾ���ص�Header��������
			curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);  //ǿ�ƻ�ȡһ���µ����ӣ���������е����ӡ�
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // ��ȡ����Ϣ���ļ�������ʽ����
			$tmpInfo = curl_exec($curl); // ִ�в���
			if (curl_errno($curl)) {
				return $url.';Error='.curl_error($curl);
				 
			}
			return $tmpInfo; // ��������
		}
	
	function isNull($value){
		if ($value==""){
			$value=0;
		}
		return $value;
	}
	
	/**
	 * ���ڱȽ���������$seacrh�����key����$Model�д���
	 * @param array $model    ģʽ����
	 * @param array $search   ����������
	 * @return boolean
	 */
	 function array_match($model=array(),$search=array())
	{
		$count = count($model);
		
		if(empty($model) || empty($search) )
			return FALSE;
			
		$keys = array_keys($search);
 
		if( $count == count(array_intersect($keys,$model)) )
		{
			return TRUE;
		}
		return FALSE;
	}
	
 	function getIPfromInt($IPint){
		return implode('.',array_reverse(explode('.',long2ip($IPint))));
	}
	
	function getIntFromIP($IPstr){
		$ip	=	implode('.',array_reverse(explode('.',$IPstr)));
		return bindec(decbin(ip2long($ip))); 
	}
	
	function jsalert($info){
		echo '<script>alert("'.$info.'");</script>';
	}
	
 	
	/*
	*	�õ��û���sessionid
	*/
	function get_sessionid($userid=''){
			$memstr = htmem('state#'.$userid); 
			$ses_long = ord($memstr{19})*256+ord($memstr{18});
			$sessionid = trim(substr($memstr,20,$ses_long)," \0");
			return $sessionid;
	}
	/*
		@getKey	Ҫ������key
		@setVal	Ϊ�ձ�ʾ��ȡ�������ַ���'delete'����ʾɾ��
		@setExp	����ֵ�Ĺ���ʱ��
		@CMP	�Ƿ�ѹ��
	*/
	function htmem($getKey='',$setVal='',$setExp=0,$CMP=FALSE){
			static $mem	=	'';
			if(empty($mem)) {  
				if(extension_loaded('memcache') ){
					$mem	=	new Memcache();
					$mem->connect(C('MEMCACHE_HOST'),C('MEMCACHE_PORT'));
				}else{
					throw_exception( 'No memcache');
					return		FALSE;
				} 
			}
			if($getKey=='' && $setVal==''){
				return	$mem;
			}
			if($setVal===''){
				return  $mem->get($getKey);
			}elseif($setVal==='delete'){
				return  $mem->delete($getKey);
			}else{
				return  $mem->set($getKey,$setVal,$CMP?MEMCACHE_COMPRESSED:$CMP,$setExp);
			}
	}
	
	function RedisMem($index=0){
				static $mem	=	array();
				if(empty($mem)) {   
						$mem['redis']	=	new Redis();
						$mem['redis']->connect(C('REDIS_HOST'),C('REDIS_PORT'));
						$mem['LastIndex']	=	0;
				}
				if(	$index != $mem['LastIndex'] ){
						$mem['redis']->select($index);
						$mem['LastIndex']	=	$index;
				}				
				return $mem['redis'] ;
	}
                function getRedisMem($cnf='REDIS',$index=0,$pcon=FALSE){
                                static $mem     =       array();
                                if(!isset($mem[$cnf])) {
                                                $mem[$cnf]                      =       [];
                                                $mem[$cnf]['redis']     =       new Redis();
                                                if($pcon){
                                                        $mem[$cnf]['redis']     ->pconnect(C($cnf.'_HOST'),C($cnf.'_PORT'));
                                                }else{
                                                        $mem[$cnf]['redis']     ->connect(C($cnf.'_HOST'),C($cnf.'_PORT'));
                                                }
                                                $mem[$cnf]['LastIndex'] =       0;
                                }

                                if(     $index != $mem[$cnf]['LastIndex'] ){
                                                $mem[$cnf]['redis']     ->select($index);
                                                $mem[$cnf]['LastIndex']         =       $index;
                                }
                                return $mem[$cnf]['redis'];
                }	
	function getRedis($host,$port,$index=0){
				static $mem	=	array();
				$key 	=	$host.':'.$port;
				if(!isset($mem[$key])) {   
						$mem[$key]	=	[];
						$mem[$key]['redis']	=	new Redis();
						$mem[$key]['redis']->connect($host,$port);
						$mem[$key]['LastIndex']	=	$index;
				}
				if(	$index != $mem[$key]['LastIndex'] ){
						$mem[$key]['redis']->select($index);
						$mem[$key]['LastIndex']	=	$index;
				}				
				return $mem[$key]['redis'] ;
	}
	
	//post�����Ƿ�Ϊ��
	function param($key,$default,$number=true){
		   return empty($_REQUEST[$key])?$default:$_REQUEST[$key]; 
	}
			
	//�޸���������ĳ��key������
	function array_change_key(&$input,$key,$replace_key){
			if(isset($input[$key])){
				$input[$replace_key]	=	$input[$key];
				unset($input[$key]);
		}
	}
	
	//�õ�UTCһ���ʱ����
	function get_today(){
			$old_tz	=	date_default_timezone_get();
			date_default_timezone_set('UTC');
			$starttime	=	date("Y-m-d H:i:s",strtotime(date('Y-m-d',time()))-28800 ); 
			$endtime	=	date("Y-m-d H:i:s",time()); 
			date_default_timezone_set($old_tz);
			return array($starttime,$endtime);
	}
	//�õ���ֹ�������ʱ�� 
	function end_day_time($timeZone='PRC'){ 
		$old_tz	=	date_default_timezone_get();
		date_default_timezone_set($timeZone);
		$left	=	strtotime(date('Y-m-d',strtotime('+1 day'))) - time(); 
		date_default_timezone_set($old_tz);
		return $left;
	}
	
	
	//�޸Ķ�ά�����key Ϊһ���ֶ�����,ת��Ϊ��������
	function array_def_key(&$input,$key){
		$new_arr	=	array();
		foreach($input as $v){
			$new_arr[$v[$key]]	=	$v;
		}
		return $new_arr;
	}
	
	//����ָ��key�ĺ�����
	function array_key_sum($arr){
		$keys	=	func_get_args();
		$arr	=	array_shift($keys);
		$sum	=	0.0;
		foreach($keys as $v){
			$sum	+=	floatval($arr[$v]);
		}
		return $sum;
	}

	//ɾ�����������ĳ��ֵ		
	function array_delete(&$input,$value){
		$id = array_search($value,$input);
		if($id !== false)  unset($input{$id});
	}
	
	//ɾ����ά��������ĳһ��
	function array_delete_column(&$input,$column){
			foreach($input as &$v){
				unset($v[$column]); 
			}
	}

	//��ȡһ������Ķ���У����һ���µĶ�ά����
	function array_columns(&$input,$column){
			$new_arr	=	array();
			$single		=	array();
			if(is_string($column))	$column	=	explode(',',$column);
			if(!is_array($input) || !is_array($column))	return FALSE;
			foreach($input as &$v){ 
				foreach($column as $vv){
					$single[$vv]	=	$v[$vv];
				}
				$new_arr[]	=	$single;
			}
			return $new_arr; 
	}



	if(!function_exists("array_column")){
		function array_column(&$input,$column){
			$new_arr = array();
			foreach($input as &$v){
				$new_arr[] = $v[$column];
			}
			return $new_arr; 
		}
	}

function get_transLang($idx){
	static $langTypeArrp = null; 
	 if( $langTypeArrp == null){
		$langTypeArrp = array_flip(['auto'=>0,'en'=>1,'eng-ind'=>1,'eng'=>1,'ko'=>2,'es'=>3,'ja'=>4,'zh'=>5,'zh-cn'=>5,'zh-Hans'=>5,'ru'=>6,'tr'=>7,'fr'=>8,'pt'=>9,'ar'=>10,'it'=>11,'de'=>12,'zh-hans'=>13,'zh-tw'=>14,'zh-chs'=>15,'th'=>16,'id'=>17,'vi'=>18,'fa'=>19,'el'=>20,'hi'=>21,'ca'=>22,'zh-hant'=>23,'pl'=>24,'nl'=>25,'sv'=>26,'iw'=>27,'bn'=>28,'no'=>29,'uk'=>30,'tl'=>31,'ro'=>32,'sq'=>33,'cy'=>34,'hy'=>35,'ms'=>36,'hu'=>37,'mn'=>38,'ur'=>39,'fi'=>40,'az'=>41,'zh-cht'=>42,'da'=>43,'hr'=>44,'kn'=>45,'la'=>46,'sr'=>47,'cs'=>48,'lt'=>49,'ka'=>50,'he'=>51,'ht'=>52,'sk'=>53,'bg'=>54,'eo'=>55,'zh-yue'=>56,'lo'=>57,'ne'=>58,'kr'=>59,'ta'=>60,'sw'=>61,'ku'=>62,'ml'=>63,'km'=>64,'sl'=>65,'et'=>66,'cn'=>67,'bs'=>68,'eu'=>69,'pa'=>70,'mk'=>71,'jp'=>72,'ha'=>73,'te'=>74,'lv'=>75,'so'=>76,'is'=>77,'mt'=>78,'af'=>79,'ce'=>80,'ceb'=>81,'or'=>82,'gu'=>83,'yo'=>84,'hmn'=>85,'be'=>86,'mr'=>87,'ga'=>88,'yi'=>89,'jv'=>90,'ig'=>91,'cn_ma'=>5,'en_us'=>1,'es_mx'=>94,'ko_kr'=>2,'id_id'=>17,'es_es'=>3,'zh_hk'=>13,'gl'=>100,'mi'=>101,'zu'=>102,'mz'=>103,'hm'=>104,'am'=>105,'kk'=>106,'tg'=>107,'my'=>108,'mg'=>109,'si'=>110,'su'=>111,'st'=>112,'uz'=>113,'vl'=>114,'nv'=>115,'ny'=>116,'xh'=>117,'ap'=>118,'tn'=>119,'nb'=>120,'nn'=>121,'hrv'=>122,'co'=>123,'nr'=>124,'dk'=>125]);
	 }
	 return is_numeric($idx) ? $langTypeArrp[$idx] : array_search($langTypeArr,$oo) ;
}

function get_language($language){
	$languagearr=array("1"=>"English","2"=>"Chinese","3"=>"Chinese_tw","4"=>"Chinese_gd","5"=>"Japanese",
"6"=>"Korean","7"=>"Spanish","8"=>"French","9"=>"Portugues","10"=>"German","11"=>"Italian",
"12"=>"Russian","13"=>"Arabic","14"=>"Turkish","15"=>"Farsi","16"=>"Azerbaijani","17"=>"Thai","18"=>"Indonesian",
"19"=>"Malay","20"=>"Tagalog","21"=>"Vietnamese","22"=>"Dutch","23"=>"Danish","24"=>"Finnish","25"=>"Norwegian",
"26"=>"Swedish","27"=>"Catalan","28"=>"Hebrew","29"=>"Polish","30"=>"Greek","31"=>"Czech","32"=>"Ukrainian","33"=>"Romanian","34"=>"Hungarian",
"35"=>"Bulgarian","36"=>"Croatian","37"=>"Serbian","38"=>"Slovak","39"=>"Hindi","40"=>"Afrikaans",
"41"=>"Esperanto","42"=>"Yiddish","43"=>"Lithuanian","44"=>"Urdu","45"=>"Tamil","46"=>"Bengali");
 return $languagearr[$language];
}
	
//��������
function DateZone($time, $timeZone = 0, $format = 'Y-m-d H:i:s' ) {
	if (empty ( $time )) {
		 $time	 = time();
	}
	$newtime = strtotime($time) + $timeZone*3600 ;
	return date ($format, $newtime );
}



//��������
function toDate($time, $format = 'Y-m-d H:i:s') {
	if (empty ( $time )) {
		 $time	 = time();
	}
	$format = str_replace ( '#', ':', $format );
	return date ($format, $time );
}


function qtDate($time, $format = 'Y-m-d H:i:s') {
	if (empty ( $time )) {
		  $time	 = time();
	}
	$format = str_replace ( '#', ':', $format );
	return date ($format, $time );
}


function qtDatet($time, $format = 'Y-m-d') {
	if (empty ( $time )) {
		 $time	 = time();
	}
	$format = str_replace ( '#', ':', $format );
	return date ($format, $time );
}



// �����ļ�
function cmssavecache($name = '', $fields = '') {
	$Model = D ( $name );
	$list = $Model->select ();
	$data = array ();
	foreach ( $list as $key => $val ) {
		if (empty ( $fields )) {
			$data [$val [$Model->getPk ()]] = $val;
		} else {
			// ��ȡ��Ҫ���ֶ�
			if (is_string ( $fields )) {
				$fields = explode ( ',', $fields );
			}
			if (count ( $fields ) == 1) {
				$data [$val [$Model->getPk ()]] = $val [$fields [0]];
			} else {
				foreach ( $fields as $field ) {
					$data [$val [$Model->getPk ()]] [] = $val [$field];
				}
			}
		}
	}
	$savefile = cmsgetcache ( $name );
	// ���в���ͳһΪ��д
	$content = "<?php\nreturn " . var_export ( array_change_key_case ( $data, CASE_UPPER ), true ) . ";\n?>";
	file_put_contents ( $savefile, $content );
}

function cmsgetcache($name = '') {
	return DATA_PATH . '~' . strtolower ( $name ) . '.php';
}
function getStatus($status, $imageShow = true) {
	switch ($status) {
		case 0 :
			$showText = '����';
			$showImg = '<IMG SRC="' . __PUBLIC__ . '/Images/locked.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="����">';
			break;
		case 2 :
			$showText = '����';
			$showImg = '<IMG SRC="' . __PUBLIC__ . '/Images/prected.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="����">';
			break;
		case - 1 :
			$showText = 'ɾ��';
			$showImg = '<IMG SRC="' . __PUBLIC__ . '/Images/del.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="ɾ��">';
			break;
		case 1 :
		default :
			$showText = '����';
			$showImg = '<IMG SRC="' . __PUBLIC__ . '/Images/ok.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="����">';

	}
	return ($imageShow === true) ?  $showImg  : $showText;

}
function getDefaultStyle($style) {
	if (empty ( $style )) {
		return 'blue';
	} else {
		return $style;
	}

}
function IP($ip = '', $file = 'UTFWry.dat') {
	$_ip = array ();
	if (isset ( $_ip [$ip] )) {
		return $_ip [$ip];
	} else {
		import ( "ORG.Net.IpLocation" );
		$iplocation = new IpLocation ( $file );
		$location = $iplocation->getlocation ( $ip );
		$_ip [$ip] = $location ['country'] . $location ['area'];
	}
	return $_ip [$ip];
}

function getNodeName($id) {
	if (Session::is_set ( 'nodeNameList' )) {
		$name = Session::get ( 'nodeNameList' );
		return $name [$id];
	}
	$Group = D ( "Node" );
	$list = $Group->getField ( 'id,name' );
	$name = $list [$id];
	Session::set ( 'nodeNameList', $list );
	return $name;
}

function get_pawn($pawn) {
	if ($pawn == 0)
		return "<span style='color:green'>û��</span>";
	else
		return "<span style='color:red'>��</span>";
}
function get_patent($patent) {
	if ($patent == 0)
		return "<span style='color:green'>û��</span>";
	else
		return "<span style='color:red'>��</span>";
}


function getNodeGroupName($id) {
	if (empty ( $id )) {
		return 'δ����';
	}
	if (isset ( $_SESSION ['nodeGroupList'] )) {
		return $_SESSION ['nodeGroupList'] [$id];
	}
	$Group = D ( "Group" );
	$list = $Group->getField ( 'id,title' );
	$_SESSION ['nodeGroupList'] = $list;
	$name = $list [$id];
	return $name;
}

function getCardStatus($status) {
	switch ($status) {
		case 0 :
			$show = 'δ����';
			break;
		case 1 :
			$show = '������';
			break;
		case 2 :
			$show = 'ʹ����';
			break;
		case 3 :
			$show = '�ѽ���';
			break;
		case 4 :
			$show = '������';
			break;
	}
	return $show;

}

// zhanghuihua@msn.com
function showStatus($status, $id, $callback="") {
	switch ($status) {
		case 0 :
			$info = '<a href="__URL__/resume/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="'.$callback.'"><img src="__MG_IMG__error.gif"></a>';
			break;
		case 2 :
			$info = '<a href="__URL__/pass/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="'.$callback.'">��׼</a>';
			break;
		case 1 :
			$info = '<a href="__URL__/forbid/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="'.$callback.'"><img src="__MG_IMG__ok.gif"></a>';
			break;
		case - 1 :
			$info = '<a href="__URL__/recycle/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="'.$callback.'">��ԭ</a>';
			break;
	}
	return $info;
}

/**
 +----------------------------------------------------------
 * ��ȡ��¼��֤�� Ĭ��Ϊ4λ����
 +----------------------------------------------------------
 * @param string $fmode �ļ���
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function build_verify($length = 4, $mode = 1) {
	return rand_string ( $length, $mode );
}


function getGroupName($id) {
	if ($id == 0) {
		return '���ϼ���';
	}
	if ($list = F ( 'groupName' )) {
		return $list [$id];
	}
	$dao = D ( "Role" );
	$list = $dao->select ( array ('field' => 'id,name' ) );
	foreach ( $list as $vo ) {
		$nameList [$vo ['id']] = $vo ['name'];
	}
	$name = $nameList [$id];
	F ( 'groupName', $nameList );
	return $name;
}
		//��ά�������ĳ������	
		function array_sort(&$arr=null,$field=null,$type=SORT_ASC)
		{ 
			if($arr==null || $field ==null)
				return null; 
			foreach ($arr as $v){
			$b[] = $v[$field];
			}
			array_multisort($b,$type,$arr);
			return;
			unset($b);
			$newarr = array();
			//��Ϊ����֮��ȥ���˹��� key��ȡusername ��Ϊ��
			foreach ($arr as $k=>$v)
			{
				$newarr[$k] = $v; 
			}
			unset($arr);
			$arr = $newarr;
		}
function sort_by($array, $keyname = null, $sortby = 'asc') {
	$myarray = $inarray = array ();
	# First store the keyvalues in a seperate array
	foreach ( $array as $i => $befree ) {
		$myarray [$i] = $array [$i] [$keyname];
	}
	# Sort the new array by
	switch ($sortby) {
		case 'asc' :
			# Sort an array and maintain index association...
			asort ( $myarray );
			break;
		case 'desc' :
		case 'arsort' :
			# Sort an array in reverse order and maintain index association
			arsort ( $myarray );
			break;
		case 'natcasesor' :
			# Sort an array using a case insensitive "natural order" algorithm
			natcasesort ( $myarray );
			break;
	}
	# Rebuild the old array
	foreach ( $myarray as $key => $befree ) {
		$inarray [] = $array [$key];
	}
	return $inarray;
}

/**
	 +----------------------------------------------------------
 * ��������ִ����������Զ���������
 * Ĭ�ϳ���6λ ��ĸ�����ֻ�� ֧������
	 +----------------------------------------------------------
 * @param string $len ����
 * @param string $type �ִ�����
 * 0 ��ĸ 1 ���� ���� ���
 * @param string $addChars �����ַ�
	 +----------------------------------------------------------
 * @return string
	 +----------------------------------------------------------
 */
function rand_string($len = 6, $type = '', $addChars = '') {
	$str = '';
	switch ($type) {
		case 0 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		case 1 :
			$chars = str_repeat ( '0123456789', 3 );
			break;
		case 2 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
			break;
		case 3 :
			$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		default :
			// Ĭ��ȥ�������׻������ַ�oOLl������01��Ҫ�����ʹ��addChars����
			$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
			break;
	}
	if ($len > 10) { //λ�������ظ��ַ���һ������
		$chars = $type == 1 ? str_repeat ( $chars, $len ) : str_repeat ( $chars, 5 );
	}
	if ($type != 4) {
		$chars = str_shuffle ( $chars );
		$str = substr ( $chars, 0, $len );
	} else {
		// ���������
		for($i = 0; $i < $len; $i ++) {
			$str .= msubstr ( $chars, floor ( mt_rand ( 0, mb_strlen ( $chars, 'utf-8' ) - 1 ) ), 1 );
		}
	}
	return $str;
}
function pwdHash($password, $type = 'md5') {
	return hash ( $type, $password );
}

/* zhanghuihua */
function percent_format($number, $decimals=0) {
	return number_format($number*100, $decimals).'%';
}
/**
 * ��̬��ȡ���ݿ���Ϣ
 * @param $tname ����
 * @param $where ��������
 * @param $order �������� �磺"id desc";
 * @param $count ȡǰ�������� 
 */
function findList($tname,$where="", $order, $count){
	$m = M($tname);
	if(!empty($where)){
		$m->where($where);
	}
	if(!empty($order)){
		$m->order($order);
	}
	if($count>0){
		$m->limit($count);
	}
	return $m->select();
}
function findById($name,$id){
	$m = M($name);
	return $m->find($id);
}
function attrById($name, $attr, $id){
	$m = M($name);
	$a = $m->where('id='.$id)->getField($attr);
	return $a;
}


//CommonModel �Զ��̳�
function CM($name){
	static $_model = array();
	if(isset($_model[$name])){
		return $_model[$name];
	}
$class=$name."Model";
import('@.Model.' . $className);
	if(class_exists($class)){
		$return=new $class();
	}else{
		$return=M("CommonModel:".$name);
	}
	$_model[$name]=$return;

return $return;
}
//��ȡ�ַ��������ĳ���� �ַ���֮����Ӵ�	
 function str_taken($str,$start,$end,$incS=TRUE,$incE=TRUE){
		$start_pos	=	strpos($str,$start);
		$start_end	=	strpos($str,$end,$start_pos);
		
		$start_len	=	strlen($start);
		$end_len	=	strlen($end);
		

		if(!$incS) $start_pos	+= $start_len;
		$take_len	=	$start_end-$start_pos+$end_len;
		if(!$incE) $take_len	-= $end_len;
		
		return substr($str,$start_pos,$take_len);
 
 }

function list_to_tree($list, $pk='id',$pid = 'pid',$child = '_child',$root=0)
{
    // ����Tree
    $tree = array();
    if(is_array($list)) {
        // ����������������������
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // �ж��Ƿ����parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if(isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

//�õ���������
 function getLanguage($languageCode){
	
	static $data	=	["����","English","Chinese","Chinese_tw","Cantonese","Japanese","Korean","Spanish","French","Portugues","German","Italian","Russian","Arabic","Turkish","Farsi","Azerbaijani","Thai","Indonesian","Malay","Tagalog","Vietnamese","Dutch","Danish","Finnish","Norwegian","Swedish","Catalan","Hebrew","Polish","Greek","Czech","Ukrainian","Romanian","Hungarian","Bulgarian","Croatian","Serbian","Slovak","Hindi","Afrikaans","Esperanto","Yiddish","Lithuanian","Urdu","Tamil","Bengali","Mongolian","Bosnian","Punjabi","Nepali","Albanian","Armenian","Basque","Belarusian","Cebuano","Estonian","Galician","Georgian","Gujarati","Haitian Creole","Hausa","Hmong","Icelandic","Igbo","Gaelic","Javanese","Kannada","Khmer","Lao","Latin","Latvian","Macedonian","Maltese","Maori","Marathi","Slovenian","Somali","Swahili","Telugu","Welsh","Yoruba","Zulu","Shanghainese","Kurdish_Sorani","Maithili","Malayalam","Oriya","Chewa","Malagasy","Sesotho","Myanmar","Sinhala","Sundanese","Kazakh","Tajik","Uzbek","Hokkien","Amharic","Flemish","Navajo","Kyrgyz","Frisian","Toki Pona","Ojibwa","Dakota","Apache","Choctaw","Xhosa","Tswana","Tsonga","Swazi","Venda","Ndebele","Lingua Franca Nova","Interlingua","Ido","Gaelic_Scottish","Kurdish_Kurmanji","Kurdish_Pehlewani","Klingon","Dothraki","Valyrian","Hawaiian","Sign_Language","Pashto"];
	
	return $languageCode === true ? $data : $data[intval($languageCode)];
}

//�õ���������
 function getLanguageZh($languageCode){
	$data=[0=>'unknown',1=>'Ӣ��',2=>'����',3=>'����(��)',4=>'����(��)',5=>'����',6=>'����',7=>'����',8=>'����',9=>'����',10=>'����',11=>'�������',12=>'����',13=>'��������',14=>'��������',15=>'��˹��',16=>'�����ݽ�',17=>'̩��',18=>'ӡ����',19=>'������',20=>'��������',21=>'Խ��',22=>'������',23=>'������',24=>'������',25=>'Ų����',26=>'�����',27=>'��̩��������',28=>'ϣ������',29=>'������',30=>'ϣ����',31=>'�ݿ���',32=>'�ڿ�����',33=>'����������',34=>'��������',35=>'����������',36=>'���޵�������'             ,37=>'����ά����',38=>'˹�工��',39=>'��ӡ����',40=>'�ϷǺ���',41=>'������',42=>' ������',43=>'��������',44=>'�ڶ�����',45=>'̹�׶���',46=>'�ϼ�����',47=>'�ɹ���',48=>'��˹����',49=>'��������',50=>'�Ჴ����',51=>'Albanian',52=>'��������',53=>'Basque',54=>'Belarusian',55=>'Cebuano',56=>'Estonian',57=>'Galician',58=>'Georgian',59=>'Gujarati',60=>'Haitian Creole',61=>'Hausa',62=>'Hmong',63=>'Icelandic',64=>'Igbo',65=>'Irish',66=>'Javanese',67=>'Kannada',68=>'������',69=>'��������',70=>'������',71=>'Latvian',72=>'Macedonian',73=>'Maltese',74=>'Maori',75=>'Marathi',76=>'Slovenian',77=>'Somali',78=>'Swahili',79=>'Telugu',80=>'Welsh',81=>'Yoruba',82=>'Zulu',83=>'Chinese_sh',84=>'Kurdish',85=>'Maithili',86=>'Malayalam',87=>'Oriya',"Chewa","Malagasy","Sesotho","Myanmar","Sinhala","Sundanese","Kazakh","Tajik","Uzbek","Hokkien","Amharic","Flemish","Navajo","Kyrgyz","Frisian","Toki Pona","Ojibwa","Dakota","Apache","Choctaw","Xhosa","Tswana","Tsonga","Swazi","Venda","Ndebele","Lingua Franca Nova","Interlingua","Ido","Gaelic_Scottish","Kurdish_Kurmanji","Kurdish_Pehlewani","Klingon","Dothraki","Valyrian","Hawaiian","Sign_Language","Pashto"];
	return $languageCode === true ? $data : $data[intval($languageCode)];
}

//���յõ�����
function getAge($date){
    $year_diff = '';
    $time = strtotime($date);
    if(FALSE === $time){
        return '';
    }

    $date = date('Y-m-d', $time);
    list($year,$month,$day) = explode("-",$date);
    $year_diff = date("Y") -$year;
    $month_diff = date("m")- $month;
    $day_diff = date("d") -$day;
    if ($day_diff < 0 || $month_diff < 0) $year_diff--; 
    return $year_diff;
}

function getCountryBySessLang($code){
	return 	 getSessionLang()=='en'?getCountryEn($code): getCountryCh($code); 
}

function getLangBySessLang($code){
	return 	 getSessionLang()=='en'?getLanguage($code): getLanguageZh($code);
}

//���������Ƶõ���������
function getCountryCh($code){
	 static $data	=	['AA'=>'��³��','AD'=>'������','AE'=>'������','AF'=>'������','AG'=>'����ϺͰͲ���','AL'=>'����������',
	 'AM'=>'��������','AN'=>'����������˹','AO'=>'������','AQ'=>'�ϼ���','AR'=>'����͢','AS'=>'����Ħ��','AT'=>'�µ���',
	 'AU'=>'�Ĵ�����','AZ'=>'�����ݽ�','Av'=>'��������',
	 'BA'=>'����','BB'=>'�ͰͶ�˹','BD'=>'�ϼ���','BE'=>'����ʱ','BF'=>'�͹���','BF'=>'�����ɷ���','BG'=>'��������','BH'=>'����','BI'=>'��¡��','BJ'=>'����','BM'=>'��Ľ��','BN'=>'������³����','BO'=>'����ά��','BR'=>'����','BS'=>'�͹���','BT'=>'����','BV'=>'��Τ��','BW'=>'��������','BY'=>'�׶���˹','BZ'=>'������','CA'=>'���ô�','CB'=>'����կ','CC'=>'�ɿ�˹Ⱥ��','CD'=>'�չ�','CF'=>'�з�','CG'=>'�չ�','CH'=>'��ʿ','CI'=>'��������','CK'=>'���Ⱥ��','CL'=>'����','CM'=>'����¡','CN'=>'�й�','CO'=>'���ױ���','CR'=>'��˹�����','CS'=>'�ݿ�˹�工��','CU'=>'�Ű�','CV'=>'��ý�'
	 ,'CX'=>'ʥ����','CY'=>'����·˹','CZ'=>'�ݿ�','DE'=>'�¹�','DJ'=>'������','DK'=>'����','DM'=>'������ӹ��͹�','DO'=>'�����������','DZ'=>'����������','EC'=>'��϶��','EE'=>'��ɳ����','EG'=>'����','EH'=>'��������','ER'=>'����������','ES'=>'������','ET'=>'���������','FI'=>'����',
	 'FJ'=>'쳼�','FK'=>'������Ⱥ��','FM'=>'�׿���������','FO'=>'����Ⱥ��','FR'=>'����','FX'=>'����-������','GA'=>'����','GB'=>'Ӣ��','GD'=>'�����ɴ�','GE'=>'��³����','GF'=>'����������','GH'=>'����','GI'=>'ֱ������','GL'=>'��������','GM'=>'�Ա���','GN'=>'������','GP'=>'����������Ⱥ��','GQ'=>'���������','GR'=>'ϣ��','GS'=>'S.GeorgiaandS.SandwichIsls.','GT'=>'Σ������','GU'=>'�ص�','GW'=>'�����Ǳ���','GY'=>'������','HK'=>'���','HM'=>'�յº��������Ⱥ��','HN'=>'�鶼��˹',
	 'HR'=>'���޵���','HT'=>'����','HU'=>'������','ID'=>'ӡ��������','IE'=>'������','IL'=>'��ɫ��','IN'=>'ӡ��','IO'=>'Ӣ��ӡ�������','IQ'=>'������','IR'=>'����','IS'=>'����','IT'=>'�����','JM'=>'�����','JO'=>'Լ��','JP'=>'�ձ�','KE'=>'������','KG'=>'������˹˹̹','KH'=>'����կ','KI'=>'�����˹','KM'=>'��Ħ��','KN'=>'ʥ���ĺ���ά˹','KP'=>'����','KR'=>'����','KW'=>'������','KY'=>'����Ⱥ��','KZ'=>'������˹̹','LA'=>'����','LB'=>'�����','LC'=>'ʥ¬����','LI'=>'��֧��ʿ��','LK'=>'˹������','LR'=>'��������','LS'=>'������','LT'=>'������','LU'=>'¬ɭ��','LV'=>'����ά��','LY'=>'������','MA'=>'Ħ���','MC'=>'Ħ�ɸ�','MD'=>'Ħ������','MG'=>'����˹��','MH'=>'���ܶ�Ⱥ��','MK'=>'�����','ML'=>'����','MM'=>'���','MN'=>'�ɹ�','MO'=>'����','MP'=>'����������Ⱥ��','MQ'=>'�����������Ⱥ��','MR'=>'ë��������','MS'=>'�������ص�','MT'=>'�����','MU'=>'ë����˹','MV'=>'�������','MW'=>'����ά','MX'=>'ī����','MY'=>'��������','MZ'=>'Īɣ�ȿ�','NA'=>'���ױ���','NC'=>'�¿��������','NE'=>'���ն�','NF'=>'ŵ���˵�','NG'=>'��������','NI'=>'�������','NL'=>'����','NO'=>'Ų��','NP'=>'�Ჴ��',
	 'NR'=>'�³','NT'=>'������(ɳ��-�����˼�)','NU'=>'Ŧ��','NZ'=>'������','OM'=>'����','PA'=>'������','PE'=>'��³','PF'=>'��������������','PG'=>'�Ͳ����¼�����','PH'=>'���ɱ�','PK'=>'�ͻ�˹̹','PL'=>'����','PM'=>'ʥƤ�������ܿ�¡Ⱥ��','PN'=>'Ƥ�ؿ˶���','PR'=>'�������','PT'=>'������','PW'=>'����','PY'=>'������','QA'=>'������','RE'=>'������������','RO'=>'��������','RU'=>'����˹',
	 'RW'=>'¬����','SA'=>'ɳ�ذ�����','SC'=>'�����','SD'=>'�յ�','SE'=>'���','SG'=>'�¼���','SH'=>'ʥ������','SI'=>'˹��������','SJ'=>'˹�߶����غ������ӵ�','SK'=>'˹�工��','SL'=>'��������','SM'=>'ʥ����ŵ','SN'=>'���ڼӶ�','SO'=>'������','SR'=>'������','ST'=>'ʥ��������������','SU'=>'ǰ����','SV'=>'�����߶�','SY'=>'������','SZ'=>'˹��ʿ��','Sb'=>'������Ⱥ��','TC'=>'�ؿ�˹�Ϳ���˹Ⱥ��','TD'=>'է��','TF'=>'�����ϲ����','TG'=>'���','TH'=>'̩��','TJ'=>'������˹̹','TK'=>'�п���Ⱥ��','TM'=>'������˹̹','TN'=>'ͻ��˹','TO'=>'����','TP'=>'������','TR'=>'������','TT'=>'�������Ͷ�͸�','TV'=>'ͼ��¬','TW'=>'̨��','TZ'=>'̹ɣ����','UA'=>'�ڿ���','UG'=>'�ڸɴ�','UK'=>'Ӣ��','UM'=>'�����������','US'=>'����','UY'=>'������','UZ'=>'���ȱ��˹̹','VA'=>'��ٸ�','VC'=>'ʥ��ɭ�غ͸����ɶ�˹','VE'=>'ί������','VG'=>'Ӣ��ά��Ⱥ��','VI'=>'����ά��Ⱥ��','VN'=>'Խ��','VU'=>'��Ŭ��³','WF'=>'����˹�͸�ͼ��Ⱥ��','WS'=>'����Ħ��','YE'=>'Ҳ��','YT'=>'��Լ�ص�','YU'=>'��˹����','ZA'=>'�Ϸ�','ZM'=>'�ޱ���','ZR'=>'������','ZW'=>'��Ͳ�Τ','RS'=>'����ά��','PS'=>'����˹̹','KT'=>'���ص���','ME'=>'�����ڸ���','AJ'=>'�����ݽ�','SX'=>'AKAʥ��','IK'=>'IK'];
	 return $code===true ? $data : $data[$code]; 
}


//���������Ƶõ���������
function getCountryEn($code){
	 	static $data	=	['AF'=>'Afghanistan','AL'=>'Albania','DZ'=>'Algeria','AS'=>'American Samoa','AD'=>'Andorra','AO'=>'Angola','AI'=>'Anguilla','AQ'=>'Antarctica','AG'=>'Antigua and Barbuda','AR'=>'Argentina','AM'=>'Armenia','AW'=>'Aruba','AU'=>'Australia','AT'=>'Austria','AZ'=>'Azerbaijan','BS'=>'The Bahamas','BH'=>'Bahrain','BD'=>'Bangladesh','BB'=>'Barbados','BY'=>'Belarus','BE'=>'Belgium','BZ'=>'Belize','BJ'=>'Benin','BM'=>'Bermuda','BT'=>'Bhutan','BO'=>'Bolivia','BA'=>'Bosnia and Herzegovina','BW'=>'Botswana','BV'=>'Bouvet Island','BR'=>'Brazil','IO'=>'British Indian Ocean Territory','BN'=>'Brunei','BG'=>'Bulgaria','BF'=>'Burkina Faso','BI'=>'Burundi','KH'=>'Cambodia','CM'=>'Cameroon','CA'=>'Canada','CV'=>'Cape Verde','KY'=>'Cayman Islands','CF'=>'Central African Republic','TD'=>'Chad','CL'=>'Chile','CN'=>'China','CX'=>'Christmas Island','CC'=>'Cocos (Keeling) Islands','CO'=>'Colombia','KM'=>'Comoros','CG'=>'Republic of the Congo','CD'=>'Democratic Republic of the Congo','CK'=>'Cook Islands','CR'=>'Costa Rica','CI'=>'Cote D\'Ivoire','HR'=>'Croatia','CU'=>'Cuba','CY'=>'Cyprus','CZ'=>'Czech Republic','DK'=>'Denmark','DJ'=>'Djibouti','DM'=>'Dominica','DO'=>'Dominican Republic','EC'=>'Ecuador','EG'=>'Egypt','SV'=>'El Salvador','GQ'=>'Equatorial Guinea','ER'=>'Eritrea','EE'=>'Estonia','ET'=>'Ethiopia','FK'=>'Falkland Islands','FO'=>'Faroe Islands','FJ'=>'Fiji','FI'=>'Finland','FR'=>'France','GF'=>'French Guiana','PF'=>'French Polynesia','TF'=>'French Southern Territories','GA'=>'Gabon','GM'=>'Gambia','GE'=>'Georgia','DE'=>'Germany','GH'=>'Ghana','GI'=>'Gibraltar','GR'=>'Greece','GL'=>'Greenland','GD'=>'Grenada','GP'=>'Guadeloupe','GU'=>'Guam','GT'=>'Guatemala','GN'=>'Guinea','GW'=>'Guinea Bissau','GY'=>'Guyana','HT'=>'Haiti','HM'=>'Heard Island and Mcdonald Islands','VA'=>'Holy See (Vatican City State)','HN'=>'Honduras','HK'=>'Hong Kong','HU'=>'Hungary','IS'=>'Iceland','IN'=>'India','ID'=>'Indonesia','IR'=>'Iran','IQ'=>'Iraq','IE'=>'Ireland','IL'=>'Israel','IT'=>'Italy','JM'=>'Jamaica','JP'=>'Japan','JO'=>'Jordan','KZ'=>'Kazakhstan','KE'=>'Kenya','KI'=>'Kiribati','KP'=>'North Korea','KR'=>'South Korea','KW'=>'Kuwait','KG'=>'Kyrgyzstan','LA'=>'Laos','LV'=>'Latvia','LB'=>'Lebanon','LS'=>'Lesotho','LR'=>'Liberia','LY'=>'Libya','LI'=>'Liechtenstein','LT'=>'Lithuania','LU'=>'Luxembourg','MO'=>'Macao','MK'=>'Macedonia','MG'=>'Madagascar','MW'=>'Malawi','MY'=>'Malaysia','MV'=>'Maldives','ML'=>'Mali','MT'=>'Malta','MH'=>'Marshall Islands','MQ'=>'Martinique','MR'=>'Mauritania','MU'=>'Mauritius','YT'=>'Mayotte','MX'=>'Mexico','FM'=>'Micronesia, Federated States of','MD'=>'Moldova','MC'=>'Monaco','MN'=>'Mongolia','MS'=>'Montserrat','MA'=>'Morocco','MZ'=>'Mozambique','MM'=>'Myanmar','NA'=>'Namibia','NR'=>'Nauru','NP'=>'Nepal','NL'=>'Netherlands','AN'=>'Netherlands Antilles','NC'=>'New Caledonia','NZ'=>'New Zealand','NI'=>'Nicaragua','NE'=>'Niger','NG'=>'Nigeria','NU'=>'Niue','NF'=>'Norfolk Island','MP'=>'Northern Mariana Islands','NO'=>'Norway','OM'=>'Oman','PK'=>'Pakistan','PW'=>'Palau' ,'PA'=>'Panama','PG'=>'Papua New Guinea','PY'=>'Paraguay','PE'=>'Peru','PH'=>'Philippines','PN'=>'Pitcairn','PL'=>'Poland','PT'=>'Portugal','PR'=>'Puerto Rico','QA'=>'Qatar','RE'=>'Reunion','RO'=>'Romania','RU'=>'Russia','RW'=>'Rwanda','SH'=>'Saint Helena','KN'=>'Saint Kitts and Nevis','LC'=>'Saint Lucia','PM'=>'Saint Pierre and Miquelon','VC'=>'Saint Vincent& Grenadines','WS'=>'Samoa','SM'=>'San Marino','ST'=>'Sao Tome and Principe','SA'=>'Saudi Arabia','SN'=>'Senegal','CS'=>'Serbia and Montenegro','SC'=>'Seychelles','SL'=>'Sierra Leone','SG'=>'Singapore','SK'=>'Slovakia','SI'=>'Slovenia','SB'=>'Solomon Islands','SO'=>'Somalia','ZA'=>'South Africa','GS'=>'South Georgia and the South Sandwich Islands','ES'=>'Spain','LK'=>'Sri Lanka','SD'=>'Sudan','SR'=>'Suriname','SJ'=>'Svalbard and Jan Mayen','SZ'=>'Swaziland','SE'=>'Sweden','CH'=>'Switzerland','SY'=>'Syria','TW'=>'Taiwan','TJ'=>'Tajikistan','TZ'=>'United Republic of Tanzania','TH'=>'Thailand','TL'=>'East Timor','TG'=>'Togo','TK'=>'Tokelau','TO'=>'Tonga','TT'=>'Trinidad and Tobago','TN'=>'Tunisia','TR'=>'Turkey','TM'=>'Turkmenistan','TC'=>'Turks and Caicos Islands','TV'=>'Tuvalu','UG'=>'Uganda','UA'=>'Ukraine','AE'=>'United Arab Emirates','UK'=>'United Kingdom','GB'=>'United Kingdom','US'=>'United States of America','UM'=>'United States Minor Outlying Islands','UY'=>'Uruguay','UZ'=>'Uzbekistan','VU'=>'Vanuatu','VE'=>'Venezuela','VN'=>'Vietnam','VG'=>'Virgin Islands, British','VI'=>'Virgin Islands, U.s.','WF'=>'Wallis and Futuna','EH'=>'Western Sahara','YE'=>'Yemen','ZM'=>'Zambia','ZW'=>'Zimbabwe','RS'=>'Serbia','PS'=>'Palestinian','KT'=>'Ivory Coast'];	

	 return $code===true ? $data : $data[$code]; 
}

		//�Զ���������
		function HtEncrypt($data, $key)
		{
			$key	=	md5($key);
			$x		=	0;
			$len	=	strlen($data);
			$l		=	strlen($key);
			$char	=	'';
			for ($i = 0; $i < $len; $i++)
			{
				if ($x == $l) 
				{
					$x = 0;
				} 
				$char .= $key{$x};
				$x++;
			}
			$str='';
			for ($i = 0; $i < $len; $i++)
			{
				$str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
			}
			return base64_encode($str);
		}
		 //�Զ���������
		function HtDecrypt($data, $key)
		{
			$key = md5($key);
			$x = 0; 
			$data = base64_decode($data); 
			$len = strlen($data);
			$l = strlen($key);
			$char	=	'';
			for ($i = 0; $i < $len; $i++)
			{
				if ($x == $l) 
				{
					$x = 0;
				}
				$char .= substr($key,$x,1);
				$x++;
			}
			$str='';
			for ($i = 0; $i < $len; $i++)
			{
				if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
				{
					$str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
				}
				else
				{
					$str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
				}
			}
			return $str;
		}
		
	/*
	*	 sphinx ����code ������֮���
	*/
	function getCountryCodeByInt($idx){
		if($idx	===	'GB'){
			$idx	=	'UK';
		};
		
		$oo =	['','US','UK','CN','HK','TW','JP','KR','FR','DE','IT','ES','AF','AL','DZ','AD','AO','AG','AR','AM','AU','AT','AZ','BS','BH','BD','BB','BY','BE','BZ','BJ','BT','BO','BA','BW','BR','BN','BG','BF','BI','KH','CM','CA','CV','CF','TD','CL','CO','KM','CD','CK','CR','CI','HR','CY','CU','CZ','DK','DJ','DM','DO','EC','EG','SV','GQ','ER','EE','ET','FO','FJ','FI','GA','GM','GE','GH','GR','GL','GD','GT','GG','GN','GW','GY','HT','HN','HU','IS','IN','ID','IR','IQ','IE','IL','JM','JE','JO','KZ','KE','KI','KW','KG','XK','LA','LV','LB','LS','LR','LY','LI','LT','LU','MO','MK','MG','MW','MY','MV','ML','MT','MH','MR','MU','MX','FM','MC','MZ','MD','MN','ME','MA','MM','NA','NR','NP','NL','NZ','NI','NE','NG','NU','KP','NO','OM','PK','PW','PS','PA','PG','PY','PE','PH','PL','PT','PR','QA','RO','RU','RW','KN','LC','VC','WS','SM','ST','SA','SN','RS','SC','SL','SG','SB','SK','SI','SO','ZA','LK','SD','SR','SZ','SE','CH','SY','SX','SS','TJ','TZ','TH','TL','TG','TO','TT','TN','TR','TM','TV','AE','UG','UA','UY','UZ','VE','VN','VU','YE','ZM','ZW','CG','IK','AC','AJ','AN','AI','AS','AW','AX','BL','BM','BQ','CW','CX','EH','GF','GI','GP','GU','IM','KY','MF','MP','MQ','MS','NC','PF','RE','SH','SJ','TC','VG','VI','YT'];
		return is_numeric($idx) ? $oo[$idx] : array_search($idx,$oo);
	}
	
		/*
	*	 ���� �������
	*/
	 function getAgeMinMax($age='8-18',&$max,&$min){
				$age_arr 					=	explode('-',$age);
				$age_arr[1] 				+=	1;
				$a	= 	(int)date('Ymd',strtotime ( '-'.$age_arr[0].' year' ) );
				$b	=	(int)date('Ymd',strtotime ( '-'.$age_arr[1].' year' ) );
				$max =	 $a > $b ? $a :$b ;
				$min =	 $a < $b ? $a :$b ;
	 }
	
	function getSphinx($connOut=2,$queOut=3){
			static $cl = null;
			if($cl == null){ 
				 
				!class_exists('SphinxClient') && require ('./Lib/ORG/sphinx.class.php');
				 
				$cl	=	 new SphinxClient();		
				$cl->SetServer(C('SPHINX_HOST'),C('SPHINX_PORT')); 
				$cl->SetConnectTimeout($connOut); 
				$cl->setMaxQueryTime($queOut);
			}
			return $cl;
	}
	
	function downFile($url,$save_dir='',$filename='' ){
		$errorNO	=	'';
		if(trim($url)==''){
			$errorNO = 'url empty';
			goto err;
		}
		if(trim($save_dir)==''){
			$save_dir='./';
		}
		if(trim($filename)==''){//�����ļ���
			$ext=strrchr($url,'.');
			 
			$filename= md5(microtime()).$ext;
		}
		
		if(0!==strrpos($save_dir,'/')){
			$save_dir.='/';
		}
		//��������Ŀ¼
		if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
			$errorNO = 'dir error';
			goto err;
		}
	 
		$file = fopen ($url, "rb");          
		if ($file) {          
			$newf = fopen ($save_dir.$filename, "wb");          
			if ($newf) {         
				while(!feof($file)) {          
					fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );          
				}
				fclose($newf);						
			}else{
				fclose($file);
				$errorNO = 'open local file error';
				goto err;
			}
			fclose($file);
		}else{
			$errorNO = 'open url error';
			goto err;
		}
		 
		//$size=strlen($img);
		//�ļ���С 

		return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
		err:
		return array('file_name'=>'','save_path'=>'','error'=>$errorNO );
		}	
		
		function sendSocketMsg($host,$port,$str,$back=0){
			$socket = socket_create(AF_INET,SOCK_STREAM,0);
			if ($socket < 0) return false;  
			$result =  socket_connect($socket,$host,$port);
			socket_set_option($socket,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>5, "usec"=>0));
			if ($result == false)return false;
			socket_write($socket,$str,strlen($str));
			if($back==2){
				return $socket;
			}
			if($back == 1){
				$input = socket_read($socket,1024 );
				socket_close ($socket);    
				return $input;
			}elseif($back==0){
				socket_close ($socket);    
				return true;    
			}        
		}		
	function  Whtmlspecialchars (&$item ,  $key='' )
	{
	  $item= htmlspecialchars($item);
	}
	
	function setDateRange(&$where,$field,$from,$end,$timezone=0){
		if(!empty($from) && !empty($end)){
			$from 	=	 strtotime($from);
			$end 	=	 strtotime($end);
			if($from==false || $end==false) return; 
			$mintime 	=	 ( $from > $end ? $end : $from ) - $timezone*3600;
			$maxtime 	= 	 ( $from > $end ? $from : $end  )- $timezone*3600;
			
			$where[$field]= array(array('egt',qtDate($mintime)),array('elt',qtDate($maxtime) ));
			
		} 
		
	}
	
	
	function setIDDateRange(&$where,$field,$from,$end,$timezone=0){
		if(!empty($from) && !empty($end)){
			$from 	=	 strtotime($from);
			$end 	=	 strtotime($end);
			if($from==false || $end==false) return; 
			$mintime 	=	 ( $from > $end ? $end : $from ) - $timezone*3600;
			$maxtime 	= 	 ( $from > $end ? $from : $end  )- $timezone*3600;
			$fromid  	=	date('Ymd',$mintime);
			$endid  	=	date('Ymd',$maxtime);
			$where[$field]= array(array('egt',$fromid),array('elt',$endid));
			
		} 
		
	}

	function getStartAndEndDate($week, $year)
	{

		$time = strtotime("1 January $year", time());
		$day = date('w', $time);
		$time += ((7*$week)+1-$day)*24*3600;
		$return[0] = $time;
		$time += 6*24*3600;
		$return[1] =  $time;
		return $return;
	}	
?>
