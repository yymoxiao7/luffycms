<?php
namespace app\admin\model;

use app\common\tools\Strings;
use \think\Db;
use \think\Model;

class Focus extends Model
{
    protected $auto = ['status', 'sort'];

    protected $type = [
        'id'          => 'integer',
        'status'      => 'integer',
        'sort'        => 'integer',
        'update_time' => 'timestamp',
        'create_time' => 'timestamp',
    ];

    /**
     * [position description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T15:22:33+0800
     * @return   [type]                   [description]
     */
    public function position()
    {
        return $this->belongsTo('focus_position', 'position_id', 'id');
    }

    /**
     * 添加焦点图
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T15:22:22+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
     */
    public function focusAdd(array $params)
    {
        return $this->save([
            'position_id' => $params['position_id'],
            'title'       => $params['title'],
            'url'         => $params['url'],
            'image'       => $params['focus_image'],
            'remark'      => $params['remark'],
            'status'      => $params['status'],
            'sort'        => $params['sort'],
        ]);
    }

    /**
     * 编辑焦点图
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T15:22:42+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function focusEdit(array $params)
    {
        $image = Db::table('focus')->where(['id' => $params['id']])->value('image');

        if ($image != $params['focus_image']) {
            Strings::deleteFile($image);
        }

        return $this->save([
            'position_id' => $params['position_id'],
            'title'       => $params['title'],
            'url'         => $params['url'],
            'image'       => $params['focus_image'],
            'remark'      => $params['remark'],
            'status'      => $params['status'],
            'sort'        => $params['sort'],
        ], ['id' => $params['id']]);
    }

    /**
     * 删除
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T15:26:54+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function deleteFocus($id)
    {
        $image = Db::table('focus')->where(['id' => $id])->value('image');
        Strings::deleteFile($image);
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
