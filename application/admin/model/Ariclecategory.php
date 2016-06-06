<?php
namespace app\admin\model;

use \think\Model;

class Ariclecategory extends Model
{
    protected $auto       = ['sort', 'description'];
    protected $dateFormat = "Y-m-d";
    protected $type       = [
        'id'          => 'integer',
        'sort'        => 'integer',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    /**
     * [user description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-20T14:36:59+0800
     * @return   [type]                   [description]
     */
    public function parent()
    {
        return $this->hasMany('ariclecategory', 'parent_id', 'id');
    }

    /**
     * [ariclecategoryAdd description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-06T16:58:42+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
     */
    public function ariclecategoryAdd(array $params)
    {
        return $this->save([
            'parent_id'   => $params['parent_id'],
            'title'       => $params['title'],
            'description' => $params['description'],
            'keyword'     => $params['keyword'],
            'sort'        => $params['sort'],
        ]);
    }

    /**
     * [ariclecategoryEdit description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-06T17:17:56+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
     */
    public function ariclecategoryEdit(array $params)
    {
        return $this->save([
            'parent_id'   => $params['parent_id'],
            'title'       => $params['title'],
            'description' => $params['description'],
            'keyword'     => $params['keyword'],
            'sort'        => $params['sort'],
        ], ['id' => $params['id']]);
    }

    /**
     * [deleteAriclecategory description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-06T17:38:41+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function deleteAriclecategory($id)
    {
        $ariclecategoryRow = self::get($id);

        if ($ariclecategoryRow == false) {
            $this->error = "分类不存在";
            return false;
        }

        if ($ariclecategoryRow->parent()->count() > 0) {
            $this->error = "本分类下还有其他分类,不能删除";
            return false;
        }

        return $ariclecategoryRow->delete();
    }

    /**
     * 列表页的字段
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T14:56:11+0800
     * @return   [type]                   [description]
     */
    public static function listField()
    {
        return self::field('id,parent_id,title,sort,update_time');
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
