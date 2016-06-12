<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Db;
use think\Input;
use think\Loader;
use think\Url;

class Personal extends AdminBase
{
    /**
     * 个人资料修改
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T15:26:15+0800
     * @return [type] [description]
     */
    public function profile()
    {
        if (IS_AJAX) {

            $params       = Input::post();
            $params['id'] = $this->userRow['id'];

            if (loader::validate('User')->scene('edit_profile')->check($params) === false) {
                return $this->error( loader::validate('User')->getError());
            }

            if (Loader::model('User')->profileEdit($params) === false) {
                return $this->error( Loader::model('User')->getError());
            }

            Loader::model('BackstageLog')->record("个人资料修改");

            return $this->success('个人资料修改成功',Url::build('admin/personal/profile'));

        }
        $userRow = Db::table('user')->find($this->userRow['id']);

        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));
        $this->assign('userRow', $userRow);

        return $this->fetch();
    }
}
