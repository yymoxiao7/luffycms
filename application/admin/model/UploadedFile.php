<?php
namespace app\admin\model;

use app\common\tools\Strings;
use think\Config;
use think\Model;
use think\Session;

class UploadedFile extends Model
{
    protected $updateTime = 'create_time';
    protected $insert     = ['user_id'];

    /**
     * [setUserId description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T14:27:19+0800
     * @param    strings                   $value [description]
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
        return Strings::fileWebLink($data['file_path'] . DS . $data['file_name']);
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

    /**
     * 标记为使用
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-26T11:19:42+0800
     * @param    [type]                   $data   [数据]
     * @param    [type]                   $uploadId [主键ID]
     * @return   [type]                             [description]
     */
    public function used($data, $uploadId, $delete = true)
    {
        if (!isset($data['type']) || !isset($data['item_id'])) {
            throw new \Exception("参数出错");
            return false;
        }
        if ($delete == true) {
            $uploadFileRows = $this->where($data)->select();
            if ($uploadFileRows) {
                foreach ($uploadFileRows as $value) {
                    $file = $value['file_path'] . DS . $value['file_name'];
                    if (file_exists($file)) {
                        unlink($file);
                    }

                    $value->delete();
                }
            }
        }
        return $this->save($data, ['id' => $uploadId]);
    }

}
