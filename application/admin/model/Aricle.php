<?php
namespace app\admin\model;

use \think\Model;

class Aricle extends Model
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
     * [aricleAdd description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-07T16:07:16+0800
     * @param    array                    $params [description]
     * @return   [type]                           [description]
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

        return isset($data['content']) ? mb_substr(strip_tags($data['content']), 0, 100, 'utf-8') : '';
    }

}
