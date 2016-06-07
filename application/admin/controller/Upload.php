<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\common\tools\Strings;
use think\Input;
use think\Loader;
use think\Request;

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
        if (Request::instance()->isPost()) {
            $optput = ['error' => 1, 'message' => '上传失败'];

            $file = Input::file('imgFile');
            if (Loader::model('ImagesInfo')->imageSize('editor', $file) === false) {
                $optput['message'] = Loader::model('ImagesInfo')->getError();
            } else {
                $info = $file->move(STATIC_PATH . DS . 'editor' . DS);

                if ($info) {

                    Loader::model('ImagesInfo')->handingImage('editor', $info);

                    $optput['url']   = Strings::fileWebLink($info->getLinkTarget());
                    $optput['error'] = 0;
                } else {
                    $optput['message'] = $file->getError();
                }
            }

            return json_encode($optput, JSON_HEX_QUOT);
        }
    }

    /**
     * 图片上传界面
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-24T09:37:42+0800
     * @param    strings                   $value [description]
     * @return   [type]                          [description]
     */
    public function index($id = 'editor')
    {
        if (Request::instance()->isPost()) {
            $optput = ['error' => '上传失败'];

            $file = Input::file('imgFile');
            if (Loader::model('ImagesInfo')->imageSize($id, $file) === false) {
                $optput['error'] = Loader::model('ImagesInfo')->getError();
            } else {
                $info = $file->move(STATIC_PATH . DS . $id . DS);

                if ($info) {

                    Loader::model('ImagesInfo')->handingImage($id, $info);

                    $optput['file']  = Strings::fileWebLink($info->getLinkTarget());
                    $optput['error'] = null;
                } else {
                    $optput['error'] = $file->getError();
                }
            }

            return $optput;
        }
        $this->assign('id', $id);
        return $this->fetch();
    }
}
