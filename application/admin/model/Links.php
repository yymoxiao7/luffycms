<?php
namespace app\admin\model;

use app\common\tools\Strings;
use think\Db;
use \think\Model;

class Links extends Model
{
    protected $auto = ['status'];

    protected $type = [
        'id'          => 'integer',
        'status'      => 'integer',
        'sort'        => 'integer',
        'update_time' => 'timestamp',
        'create_time' => 'timestamp',
    ];

    /**
     * 添加友情链接
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T09:46:32+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
     */
    public function linksAdd(array $params)
    {
        return $this->save([
            'title'  => $params['title'],
            'url'    => $params['url'],
            'logo'   => $params['links_logo'],
            'linker' => $params['linker'],
            'status' => isset($params['status']) ? $params['status'] : 0,
            'sort'   => $params['sort'],
        ]);
    }

    /**
     * 修改友情链接
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T10:10:45+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
     */
    public function linksEdit(array $params)
    {
        $logo = Db::table('links')->where(['id' => $params['id']])->value('logo');

        if ($logo != $params['links_logo']) {
            Strings::deleteFile($logo);
        }

        return $this->save([
            'title'  => $params['title'],
            'url'    => $params['url'],
            'logo'   => $params['links_logo'],
            'linker' => $params['linker'],
            'status' => $params['status'],
            'sort'   => $params['sort'],
        ], ['id' => $params['id']]);
    }

    /**
     * 删除友情链接
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T10:17:40+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function deleteLinks($id)
    {
        $logo = Db::table('links')->where(['id' => $id])->value('logo');
        Strings::deleteFile($logo);
        return self::destroy($id);
    }

    /**
     * 获取状态
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-19T16:00:40+0800
     * @param    strings                   $value [description]
     * @return   [type]                          [description]
     */
    protected function getStatusAttr($value)
    {
        $status = [0 => '禁用', 1 => '启用'];
        return $status[$value];
    }

    /**
     * 获取排序
     * @param  [type] $sort [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    protected function getSortAttr($sort, $data)
    {
        return '<input type="text" value="' . $sort . '" class="sort"/>';
    }

}
