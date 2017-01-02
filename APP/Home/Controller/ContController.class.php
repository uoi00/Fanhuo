<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
session_start();//开启session
class ContController extends Controller {
    //在线检测
    public function _initialize(){
        if(empty($_SESSION["user"]['name'])){
            $this->error("登录超时，请重新登录",__APP__."/Home/Index/index");
        }
        $this->assign('user',$_SESSION['user']['name']);
    }
    //注销
    public function desc(){
       unset($_SESSION);
       session_destroy();
       $this->success("注销成功",__APP__."/Home/Index/index",0);
    }
    //使用模板
    protected function tp_layout($title,$css_name,$js_file,$js_cont,$mod){
        layout('Layout/public');
        $this->assign('title',$title);//模板标题
        $this->assign('css_name',$css_name);//要引入的css文件--数组
        $this->assign('js_file',$js_file);//要引入的js文件--数组
        $this->assign('js_cont',$js_cont);//需要附加的js代码
        $this->display($mod);//要渲染的页面
    }
    //添加数据库
    protected function my_add($table , $data){
        try {
            $mod =new Model($table);
            $mod->startTrans();
            $rst = $mod->data($data)->add();
        }catch (Exception $e){
            $mod->rollback();
            return false;
        }finally{
            if ($rst === false ){
                $mod->rollback();
                return false;
            }else{
                $mod->commit();
                return true;
            }
        }
    }
    //二维数组的json格式输出(主要用于数据库查询结果的json输出)
    protected function json_echo($arr){
        for ($i = 0; $dt = $arr[$i]; $i++) {
            $aa[$i] = json_encode($dt);
        }
        return json_encode($aa);
    }
    //查询关注用户
    protected function my_look(){
        $mod = M('look');
        $id_u = $mod->field('id_u')->where("id_a = '{$_SESSION[user][id]}'")->select();
        $i=0;
        foreach ($id_u as $val){
            $look[$i++] = $val['id_u'];
        }
        return $look;
    }
    //通过ID获取用户名和邮箱
    protected function id_name($id){
        $mod = M('user');
        $rst = $mod->field('name,user')->where("id = '$id'")->select();
        return $rst[0]['name'].'('.$rst[0]['user'].')';
    }

    protected function domx($file){
        if($file=='') {
            $file = $_SERVER['DOCUMENT_ROOT'] . __ROOT__ . '/Public/conf/' . "$_SESSION[id].xml";//配置文件名
        }
        $xml=new \DOMDocument();
        $xml->load($file);
        return $xml;
    }
    protected function smpx($file){
        if($file=='') {
            $file = $_SERVER['DOCUMENT_ROOT'] . __ROOT__ . '/Public/conf/' . "$_SESSION[id].xml";//配置文件名
        }
        $xml=simplexml_load_file($file);// 加载文件
        return $xml;
    }
    protected function jsec($c){
        echo "<script type='text/javascript'> $c </script>";
    }
}