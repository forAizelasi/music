<?php
namespace app\index\controller;

use think\View;
use think\Controller;


class Index extends Controller
{
    public function index()
    {
        $view = new View();

        return $this->fetch();

    }

    public function browse()
    {
        $view = new View();
        return$this->fetch();
    }

    public function cuowu()
    {
        $view = new View();
        return$this->fetch();
    }

    public function radio()
    {
        $view = new View();
        return$this->fetch();
    }

    public function typography()
    {
        $view = new View();
        return$this->fetch();
    }

}



































