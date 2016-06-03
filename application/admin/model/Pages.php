<?php
namespace app\admin\model;

use \think\Model;

class Pages extends Model
{
    protected $auto       = ['status', 'sort', 'description'];
    protected $dateFormat = "Y-m-d";
    protected $type       = [
        'id'          => 'integer',
        'status'      => 'integer',
        'sort'        => 'integer',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    /**
     * [pageAdd description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T15:31:22+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
     */
    public function pageAdd(array $params)
    {
        return $this->save([
            'parent_id'   => $params['parent_id'],
            'title'       => $params['title'],
            'description' => $params['description'],
            'keyword'     => $params['keyword'],
            'content'     => $params['content'],
            'status'      => $params['status'],
            'sort'        => $params['sort'],
        ]);
    }

    /**
     * [pageEdit description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T16:44:53+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
     */
    public function pageEdit(array $params)
    {
        return $this->save([
            'parent_id'   => $params['parent_id'],
            'title'       => $params['title'],
            'description' => $params['description'],
            'keyword'     => $params['keyword'],
            'content'     => $params['content'],
            'status'      => $params['status'],
            'sort'        => $params['sort'],
        ], ['id' => $params['id']]);
    }
    /**
     * 设置简介
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T14:30:17+0800
     * @param    [type]                   $description [description]
     * @param    [type]                   $data        [description]
     */
    protected function setDescriptionAttr($description, $data)
    {
        if ($description != '') {
            return $description;
        }

        return isset($data['content']) ? mb_substr($data['content'], 0, 100) : '';
    }

    /**
     * [user description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-20T14:36:59+0800
     * @return   [type]                   [description]
     */
    public function parent()
    {
        return $this->hasMany('pages', 'parent_id', 'id');
    }

    /**
     * 列表页的字段
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T14:56:11+0800
     * @return   [type]                   [description]
     */
    public static function listField()
    {
        return self::field('id,parent_id,title,description,keyword,status,sort,update_time');
    }

    /**
     * 列表页的字段
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T14:56:11+0800
     * @return   [type]                   [description]
     */
    public static function selectField()
    {
        return self::field('id,title,parent_id');
    }

    /**
     * 获取状态
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-19T16:00:40+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function getStatusAttr($islink, $data)
    {
        $islinks = [0 => '<span class="label label-success">不显示</span>', 1 => '<span class="label label-info">显示 </span>'];
        return $islinks[$islink];
    }

    /**
     * 获取排序
     * @param  [type] $sort [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function getSortAttr($sort, $data)
    {
        return '<input type="text" value="' . $sort . '" class="sort"/>';
    }
}
