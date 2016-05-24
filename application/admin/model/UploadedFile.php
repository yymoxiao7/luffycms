<?php
namespace app\admin\model;

use think\Config;
use think\Model;
use think\Session;
use app\common\tools\String;

class UploadedFile extends Model
{
    protected $updateTime = 'create_time';
    protected $insert     = ['user_id'];

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

    protected function getFileAttr($value, $data)
    {
        return String::fileWebLink($data['file_path'] . DS . $data['file_name']);
    }

    /**
     * 保存上传的文件到数据库
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T14:25:32+0800
     * @param    [type]                   $remark [description]
     * @return   [type]                           [description]
     */
    public function record(\SplFileInfo $splFileInfo, $type)
    {
        return $this->save([
            'file_type' => $splFileInfo->getExtension(),
            'file_size' => $splFileInfo->getSize(),
            'file_name' => $splFileInfo->getFilename(),
            'file_path' => $splFileInfo->getPath(),
            'type'      => $type,
        ]);
    }

}
