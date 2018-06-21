<?php
/**
 * Created by PhpStorm.
 * User: shuo
 * Date: 2018/6/20
 * Time: 上午10:02
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin;
use think\Request;

class Home extends BaseAdmin
{
    public function home()
    {
        return $this->fetch();
    }
    //欢迎页面
    public function welcome()
    {
        return $this->fetch();
    }
}