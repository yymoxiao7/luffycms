<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use \app\common\tools\DbManage;
use \think\Db;
use \think\Loader;

class Databases extends AdminBase
{
    /**
     * 数据库备份
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T14:13:25+0800
     * @return [type] [description]
     */
    public function index()
    {
        $databaseRows = array_map('array_change_key_case', Db::query('SHOW TABLE STATUS'));
        $this->assign('databaseRows', $databaseRows);

        return $this->fetch();
    }

    /**
     * 优化表
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T14:31:48+0800
     * @param  [type] $table [description]
     * @return [type] [description]
     */
    public function optimize($table)
    {
        $optimize = Db::execute('OPTIMIZE TABLE `{$table}`');
        if ($optimize) {
            Loader::model('BackstageLog')->record("优化数据表：[{$table}]");

            return $this->result([],3,"数据表【{$table}】优化成功");
        } else {
            return $this->result([],4,"数据表【{$table}】优化失败");
        }
    }

    /**
     * 修复表
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T14:40:25+0800
     * @param  [type] $table [description]
     * @return [type] [description]
     */
    public function repair($table)
    {
        $optimize = Db::execute('REPAIR TABLE `{$table}`');
        if ($optimize) {
            Loader::model('BackstageLog')->record("修复数据表：[{$table}]");

            return $this->result([],3,"数据表【{$table}】修复成功");
        } else {
            return $this->result([],4,"数据表【{$table}】修复失败");
        }
    }

    /**
     * 备份
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T14:40:25+0800
     * @param  [type] $table [description]
     * @return [type] [description]
     */
    public function backup($table)
    {
        $backup = DbManage::backup($table);
        if ($backup) {
            Loader::model('BackstageLog')->record("备份数据表：[{$table}]");

            return $this->result([],3,"数据表【{$table}】备份成功");
        } else {
            return $this->result([],4,"数据表【{$table}】备份失败");
        }
    }
}
