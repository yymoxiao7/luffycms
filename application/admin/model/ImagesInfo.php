<?php
namespace app\admin\model;

use app\common\tools\Image;
use SplFileInfo;
use \think\Db;
use \think\Model;

class ImagesInfo extends Model
{
    /**
     * 处理图片
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T15:08:26+0800
     * @param    [type]                   $path [description]
     * @param    SplFileInfo              $file [description]
     * @return   [type]                         [description]
     */
    public function handingImage($path, SplFileInfo $file)
    {
        $imageInfo = Db::table('images_info')->field('width,height,remark')->where(['path' => $path])->find();

        if ($imageInfo) {
            if ($imageInfo['width'] > 0 && $imageInfo['height'] > 0) {
                (new Image([
                    'sourceImage' => $file->getRealPath(),
                    'width'       => $imageInfo['width'],
                    'height'      => $imageInfo['height'],
                ]))->resize();
            }
        }
    }

    /**
     * [imageSize description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T15:14:23+0800
     * @param    [type]                   $path [description]
     * @param    [type]                   $file [description]
     * @return   [type]                         [description]
     */
    public function imageSize($path, $file)
    {
        $imageInfo = Db::table('images_info')->field('size,remark')->where(['path' => $path])->find();
        if ($imageInfo && $imageInfo['size'] > 0 && ($imageInfo['size'] < ($file->getSize() / 1024))) {
            $this->error = $imageInfo['remark'] . "上传的图片不能大于" . $imageInfo['size'] . 'kb';
            return false;
        }
        return true;
    }
}
