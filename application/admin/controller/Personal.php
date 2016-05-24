<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Input;
use think\Loader;

class Personal extends AdminBase
{
    /**
     * 个人资料修改
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T15:26:15+0800
     * @return   [type]                   [description]
     */
    public function profile()
    {
        if (IS_AJAX) {

            $params = Input::post();
            // 头像处理
            if (isset($params['profile_head']) && is_numeric($params['profile_head'])) {
                $fileModel = Loader::model('UploadedFile')->find($params['profile_head']);
                if ($fileModel) {
                    $params['head'] = $fileModel->file;
                }
                unset($params['profile_head']);
            }
            //密码处理
            if (isset($params['password']) && $params['password']) {

            } else {
                unset($params['password']);
            }

            $params['id'] = $this->userRow['id'];

            if (Loader::model('User')->validate('User.edit_profile')->save($params, ['id' => $this->userRow['id']]) === false) {
                return ['status' => 0, 'data' => Loader::model('User')->getError()];
            }

            return ['status' => 1, 'url' => Url::build('admin/personal/profile')];

        }
        $this->assign('userRow', $this->userRow);
        return $this->fetch();
    }
}
