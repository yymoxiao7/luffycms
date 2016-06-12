<?php
namespace app\admin\model;

use \think\Cache;
use \think\Db;
use \think\Model;

class Variable extends Model
{

    protected $valuePath = "Variable";

    /**
     * 通过key 获取到value的值
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T14:14:59+0800
     * @param  [type] $key [description]
     * @return [type] [description]
     */
    public function getValueBykey($key)
    {
        $value = DB::table('variable')->where('key', $key)->value('value');
        if (!$value) {
            $value = $this->getValue($key);
        }

        return $value;
    }
    /**
     * [addVariable description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-30T15:05:37+0800
     * @param array $params [description]
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
     * 修改
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T11:26:21+0800
     * @param  array  $params [description]
     * @return [type] [description]
     */
    public function editVariable(array $params)
    {
        $save = $this->save([
            'description' => $params['description'],
            'input_types' => $params['input_types'],
            'check'       => $params['check'],
        ], [
            'key' => $params['key'],
        ]);

        if ($save === false) {
            return false;
        }

        return $params['key'];
    }

    /**
     * [setVariable description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T10:43:33+0800
     * @param array $params [description]
     */
    public function setVariable(array $params)
    {
        if (mb_strlen($params['value']) >= 255) {
            $this->setValue($params['key'], $params['value']);
            $params['value'] = '';
        }

        return $this->save([
            'value' => $params['value'],
        ], ['key' => $params['key']]);
    }

    /**
     * [deleteVariable description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T11:30:50+0800
     * @param  string $value [description]
     * @return [type] [description]
     */
    public function deleteVariable($key)
    {
        self::destroy($key);
        $this->deleteValue($key);

        return true;
    }
    /**
     * 获取变量值
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T10:48:20+0800
     * @param  string $value [description]
     * @return [type] [description]
     */
    protected function getValueAttr($value, $data)
    {
        if (($valueFile = $this->getValue($data['key'])) === false) {
            return $value;
        }

        return $valueFile;
    }

    /**
     * 获取 文件值
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T10:49:17+0800
     * @param  [type] $key [description]
     * @return [type] [description]
     */
    protected function getValue($key)
    {
        $file = RUNTIME_PATH . $this->valuePath . DS . md5($key);

        if (file_exists($file) && is_file($file)) {
            return file_get_contents($file);
        }

        return false;
    }

    /**
     * 删除文件值
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T11:31:11+0800
     * @param [type] $key [description]
     */
    protected function deleteValue($key)
    {
        $file = RUNTIME_PATH . $this->valuePath . DS . md5($key);
        if (file_exists($file) && is_file($file)) {
            return unlink($file);
        }
    }

    /**
     * 保存 文件值
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T10:52:52+0800
     * @param [type] $key   [description]
     * @param [type] $value [description]
     */
    protected function setValue($key, $value)
    {
        $file = RUNTIME_PATH . $this->valuePath . DS;
        if (!file_exists($file)) {
            mkdir($file, 0755, true);
        }

        return file_put_contents($file . md5($key), $value);
    }
    /**
     * [getInputTypesAttr description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-30T15:42:18+0800
     * @param  [type] $value [description]
     * @return [type] [description]
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
