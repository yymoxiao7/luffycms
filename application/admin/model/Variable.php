<?php
namespace app\admin\model;

use \think\Cache;
use \think\Db;
use \think\Model;

class Variable extends Model
{
    protected $autoWriteTimestamp = false;

    /**
     * [addVariable description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-30T15:05:37+0800
     * @param    array                    $params [description]
     */
    public function addVariable(array $params)
    {
        $save = $this->save([
            'key'         => $params['key'],
            'description' => $params['description'],
            'input_types' => $params['input_types'],
            'check'       => $params['check'],
        ]);

        if ($save === false) {
            return false;
        }

        return $params['key'];
    }

    /**
     * [getInputTypesAttr description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-30T15:42:18+0800
     * @param    [type]                   $value [description]
     * @return   [type]                          [description]
     */
    protected function getInputTypesAttr($value)
    {
        $type = array();
        $key  = 'variable_type' . $value;
        if (($type = Cache::get($key)) === false) {
            $type = Db::table('variable_type')->where(['type' => $value])->find();
            Cache::set($key, $type);
        }
        return isset($type['name']) ? $type['name'] : '';
    }

}
