<?php
namespace app\admin\controller;

class Index
{
    public function index()
    {
        echo \app\common\tools\Visitor::getBrowser();
        echo "<br />";
        echo \app\common\tools\Visitor::getBrowserVer();
        echo "<br />";
        echo \app\common\tools\Visitor::getIP();
        echo "<br />";
        echo \app\common\tools\Visitor::getOs();
        echo "<br />";
    }
}
