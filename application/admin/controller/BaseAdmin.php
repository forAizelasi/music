<?php
/**
 * Created by PhpStorm.
 * User: shuo
 * Date: 2018/6/20
 * Time: 上午10:06
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin;
use think\Request;

class BaseAdmin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_info = session('info');
        //未登陆的用户不允许访问
        if (!$this->_info){
            header('Location:/admin/Login/login');
            exit;
        }
        //判断用户是否有权限访问

    }
}