<?php
/**
 * Created by PhpStorm.
 * User: shuo
 * Date: 2018/6/20
 * Time: 下午2:03
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin;
use think\Request;
use app\admin\model\Groups;
use think\Db;

class Admins extends BaseAdmin
{
    //管理员列表
    public function index()
    {
        $data = Admin::all();
        $res = collection(Groups::all())->toArray();
        //var_dump($res);
        $this->assign('data',$data);
        $this->assign('res',$res);
        return $this->fetch();
    }

    //添加管理员
    public function add()
    {
        $id = (int)input('get.id');
        //加载管理员
        $res['item'] = Db::table('music_admin')->where(array('a_id'=>$id))->find();
        //加载角色
        $data = Groups::all();
        $this->assign('data',$data);
        $this->assign('res',$res);
        return $this->fetch();
    }

    //保存管理员
    public function save()
    {
        $id = (int)input('post.id');
        $data['name'] = trim(input('post.username'));
        $password = trim(input('post.password'));


        $data['gid'] = (int)input('post.gid');
        $data['truename'] = trim(input('post.truename'));

        $name = $data['name'];

        if (!$data['name'])
        {
            exit(json_encode(array('code'=>1,'msg'=>'用户名不能为空')));
        }
        if (!$data['gid'])
        {
            exit(json_encode(array('code'=>1,'msg'=>'角色不能为空')));
        }
        if ($id==0 && !$password)
        {
            exit(json_encode(array('code'=>1,'msg'=>'密码不能为空')));
        }
        if (!$data['truename'])
        {
            exit(json_encode(array('code'=>1,'msg'=>'姓名不能为空')));
        }

        if ($password){
            //密码处理
            $data['password'] = md5($data['name'].$password);
        }

        if ($id==0){
            //检查用户是否已存在
            $item = Db::table('music_admin')->where("name='$name'")->find();
            if ($item)
            {
                exit(json_encode(array('code'=>1,'msg'=>'用户已存在')));
            }
            //保存用户
            $data['addTime'] = time();
            $res = Db::table('music_admin')->insert($data);
        }else{
            $res = Db::table('music_admin')->where('a_id',$id)->update($data);
        }



        if (!$res){
            exit(json_encode(array('code'=>1,'msg'=>'保存失败')));
        }
        exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
    }

    //删除管理员
    public function delete()
    {
        $id = (int)input('post.a_id');
        $res = Db::table('music_admin')->where('a_id',$id)->delete();

        if (!$res)
        {
            exit(json_encode(array('code'=>1,'msg'=>'删除失败')));
        }else{
            exit(json_encode(array('code'=>0,'msg'=>'删除成功')));
        }
    }

    //修改状态
    public function upd()
    {
        $id = (int)input('post.a_id');
        $data = Db::table('music_admin')->field('status')->where('a_id',$id)->select();
        //var_dump($data);
        foreach ($data as $v){
            if ($v['status'] == 1){
                echo 1111;
                //$res = Db::table('music_admin')->where('a_id',$id)->update(['status'=>'0']);
                //dump($res);
            }else{
                echo 111;
                //$res = Db::table('music_admin')->where('a_id',$id)->update(['status'=>'1']);
            }
        }



    }

}