<?php
namespace app\admin\model;

use \think\Model;

class FocusPosition extends Model
{
    protected $type = [
        'id'          => 'integer',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    /**
     * 添加位置
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T11:15:30+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
     */
    public function positionAdd(array $params)
    {
        return $this->save([
            'code' => $params['code'],
            'name' => $params['name'],
        ]);
    }

    /**
     * 修改位置
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T11:51:54+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
     */
    public function positionEdit(array $params)
    {
        return $this->save([
            'code' => $params['code'],
            'name' => $params['name'],
        ], ['id' => $params['id']]);
    }

    /**
     * 删除位置
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T11:56:52+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function deletePosition($id)
    {
        if (self::get($id)->focus()->count() > 0) {
            $this->error = '位置下还有焦点图,不能删除';
            return false;
        }

        return self::destroy($id);
    }

    /**
     * [focus description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T11:23:31+0800
     * @return   [type]                   [description]
     */
    public function focus()
    {
        return $this->hasMany('Focus', 'position_id', 'id');
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
