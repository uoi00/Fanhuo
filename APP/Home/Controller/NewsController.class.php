<?php
namespace Home\Controller;
use Think\Controller;
session_start();//开启session
class NewsController extends ContController {
    public function index(){
        echo '程序猿正在完善中哦';
//        $this->display('index');
    }
}