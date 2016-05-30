<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Db;
use think\Input;
use think\Loader;
use think\Url;

class Variable extends AdminBase
{
    /**
     * [index description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-30T14:11:25+0800
     * @return   [type]                   [description]
     */
    public function index()
    {
        $variableMobel = Loader::model('Variable');
        $variableRows  = $variableMobel::paginate(25);

        $this->assign('variableRows', $variableRows);
        $this->assign('pages', $variableRows->render());
        return $this->fetch();
    }

    /**
     * [add description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-30T14:11:32+0800
     */
    public function add()
    {
        if (IS_AJAX) {
            $params = Input::param();

            if (loader::validate('Variable')->scene('add')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('Variable')->getError()];
            }

            if (($key = Loader::model('Variable')->addVariable($params)) === false) {
                return ['status' => 0, 'data' => Loader::model('Variable')->getError()];
            }

            Loader::model('BackstageLog')->record("添加自定义变量：[{$key}]");

            return ['status' => 1, 'url' => Url::build('admin/variable/index')];

        }
        $this->assign('inputTypes', Db::table('variable_type')->select());
        return $this->fetch();
    }

    /**
     * 设置变量的值
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-30T15:48:17+0800
     * @param    [type]                   $key [description]
     */
    public function set($key)
    {
        $variableMobel = Loader::model('Variable');

        $this->assign('variableRow', $variableMobel->get($key));
        return $this->fetch();
    }
}
