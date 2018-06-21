<?php
/**
 * Created by PhpStorm.
 * User: shuo
 * Date: 2018/6/19
 * Time: 下午4:44
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin;
use think\Request;

class Login extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function dologin(Request $request)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username == ''){
            exit(json_encode(array('code'=>1,'msg'=>'用户名不能为空')));
        }
        if ($password == ''){
            exit(json_encode(array('code'=>1,'msg'=>'密码不能为空')));
        }

        $info = Admin::where(['name'=>$username,'password'=>$password])->find();
        if (!$info){
            exit(json_encode(array('code'=>1,'msg'=>'用户不存在')));
        }
        if ($password != $info['password']){
            exit(json_encode(array('code'=>1,'msg'=>'密码错误')));
        }
        if ($info['isSuper'] == 0){
            exit(json_encode(array('code'=>1,'msg'=>'没有权限')));
        }
        if ($info['status'] == 0){
            exit(json_encode(array('code'=>1,'msg'=>'用户被锁定')));
        }

        //设置用户session
        session('info',$info);
        exit(json_encode(array('code'=>0,'msg'=>'登陆成功')));
    }
}