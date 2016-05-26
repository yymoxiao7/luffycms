<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\common\tools\Strings;
use \think\Input;
use \think\Loader;

class Upload extends AdminBase
{
    /**
     * 个人资料修改
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T15:26:15+0800
     * @return   [type]                   [description]
     */
    public function uploadpic()
    {
        $data               = Input::param();
        $data['defaultImg'] = '/static/admin/images/default_head.gif';

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 图片上传界面
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-24T09:37:42+0800
     * @param    strings                   $value [description]
     * @return   [type]                          [description]
     */
    public function index($type, $id)
    {
        if ($type == '') {
            throw new \Exception("错误", 1);
        }
        if (IS_POST) {
            $optput = ['error' => '上传失败'];

            $file = Input::file('file');
            $info = $file->move(STATIC_PATH . DS . 'upload' . DS);

            if ($info) {
                // 保存至UploadedFile表
                $uploadId = Loader::model('UploadedFile')->record($info, $type);

                $optput['file']      = Strings::fileWebLink($info->getLinkTarget());
                $optput['upload_id'] = (int) $uploadId;
                $optput['error']     = null;
            } else {
                $optput['error'] = $file->getError();
            }

            return $optput;
        }

        $uploadRows = Loader::model('UploadedFile')->where([
            'type'    => $type,
            'item_id' => 0,
        ])->select();

        $this->assign('uploadRows', $uploadRows);
        $this->assign('type', $type);
        $this->assign('id', $id);
        return $this->fetch();
    }
}
