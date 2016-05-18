<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use \think\Input;
use \think\Loader;
use \think\Url;

class Rule extends AdminBase
{
    /**
     * 菜单列表
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T11:30:49+0800
     * @return   [type]                   [description]
     */
    public function index()
    {
        $ruleModel = Loader::model('Rule');
        $lists     = $ruleModel::select();

        $this->assign('lists', $lists);
        return $this->fetch();
    }

    /**
     * 添加菜单
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T14:42:48+0800
     * @param    string                   $value [description]
     */
    public function add()
    {
        if (IS_AJAX) {
            $data   = Input::param();
            $result = $this->validate($data, "Rule.add");

            if ($result !== true) {
                return ['status' => 0, 'data' => $result];
            }

            $ruleModel = Loader::model('Rule');

            $ruleModel->save($data);

            return ['status' => 1, 'url' => Url::build('admin/rule/index')];

        } else {
            $ruleRows = Loader::model('Rule')->getMenusByParentId(0);
            $this->assign('ruleRows', $ruleRows);
            return $this->fetch();
        }
    }

    /**
     * 编辑
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-18T10:27:08+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function edit($id)
    {
        $ruleRow = \think\Db::table('rule')->find($id);
        if (empty($ruleRow)) {
            $this->error('没有找到对应的id!');
        }

        $ruleRows = Loader::model('Rule')->getMenusByParentId(0);

        $this->assign('ruleRow', $ruleRow);
        $this->assign('ruleRows', $ruleRows);
        return $this->fetch();
    }
}
