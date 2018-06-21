<?php
/**
 * Created by PhpStorm.
 * User: shuo
 * Date: 2018/6/21
 * Time: 下午10:34
 */
namespace app\admin\controller;

use app\admin\controller\BaseAdmin;
use think\Db;

class Menu extends BaseAdmin
{
    //菜单列表
    public function index()
    {
        $data = Db::table('music_menus')->select();
        $this->assign('data',$data);
        return $this->fetch();
    }
}