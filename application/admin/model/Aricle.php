<?php
namespace app\admin\model;

use app\common\tools\Strings;
use \think\Model;

class Aricle extends Model
{
    protected $auto = ['status', 'sort', 'description'];

    protected $type = [
        'id'          => 'integer',
        'status'      => 'integer',
        'sort'        => 'integer',
        'update_time' => 'timestamp',
        'create_time' => 'timestamp',
    ];

    public function category()
    {
        return $this->belongsTo('ariclecategory', 'category_id', 'id');
    }

    /**
     * [aricleAdd description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-07T16:07:16+0800
     * @param  array  $params [description]
     * @return [type] [description]
     */
    public function aricleAdd(array $params)
    {
        return $this->save([
            'category_id' => $params['category_id'],
            'title'       => $params['title'],
            'thumbnail'   => $params['aricle-thumbnail'],
            'description' => $params['description'],
            'keyword'     => $params['keyword'],
            'content'     => $params['content'],
            'status'      => isset($params['status']) ? $params['status'] : 0,
            'sort'        => $params['sort'],
        ]);
    }

    /**
     * [aricleEdit description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-12T10:29:50+0800
     * @param  array  $params [description]
     * @return [type] [description]
     */
    public function aricleEdit(array $params)
    {
        $aricleRow = self::get($params['id']);

        if ($aricleRow === false) {
            $this->error = "文章不存在或者已删除！";

            return false;
        }

        if ($aricleRow->thumbnail != $params['aricle-thumbnail']) {
            Strings::deleteFile($aricleRow->thumbnail);
        }

        return $this->save([
            'category_id' => $params['category_id'],
            'title'       => $params['title'],
            'thumbnail'   => $params['aricle-thumbnail'],
            'description' => $params['description'],
            'keyword'     => $params['keyword'],
            'content'     => $params['content'],
            'status'      => isset($params['status']) ? $params['status'] : 0,
            'sort'        => $params['sort'],
        ], ['id' => $params['id']]);

    }

    /**
     * [deleteAricle description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-07T17:48:40+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function deleteAricle($id)
    {
        $aricleRow = self::get($id);
        if ($aricleRow === false) {
            $this->error = "文章不存在或者已删除！";

            return false;
        }
        Strings::deleteFile($aricleRow->thumbnail);

        return $aricleRow->delete();
    }
    /**
     * 设置简介
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T14:30:17+0800
     * @param [type] $description [description]
     * @param [type] $data        [description]
     */
    protected function setDescriptionAttr($description, $data)
    {
        if ($description != '') {
            return $description;
        }

        return isset($data['content']) ? mb_substr(strip_tags($data['content']), 0, 100, 'utf-8') : '';
    }

    /**
     * 获取状态
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-19T16:00:40+0800
     * @param  string $value [description]
     * @return [type] [description]
     */
    public function getStatusAttr($value, $data)
    {
        $status = [1 => '<span class="label label-success">启用</span>', 0 => '<span class="label label-warning">禁用</span>'];

        return $status[$value];
    }

    /**
     * 获取排序
     * @param  [type] $sort [description]
     * @param  [type] $data [description]
     * @return [type] [description]
     */
    public function getSortAttr($sort, $data)
    {
        return '<input type="text" value="' . $sort . '" class="sort"/>';
    }

}
