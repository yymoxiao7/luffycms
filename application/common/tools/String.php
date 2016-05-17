<?php
namespace app\common\tools;

/**
 * 获取受访者信息
 */
class String
{

    /**
     * 替换字符串中间位置字符为星号
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T10:29:46+0800
     * @param    [type]                   $str [description]
     * @return   [type]                        [description]
     */
    public static function replaceToStar($str)
    {
        $len = strlen($str) / 2;
        return substr_replace($str, str_repeat('*', $len), floor(($len) / 2), $len);
    }
}
