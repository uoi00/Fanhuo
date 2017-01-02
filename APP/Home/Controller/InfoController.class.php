<?php
namespace Home\Controller;
use Think\Exception;
use Think\Model;

session_start();//开启session
class InfoController extends ContController {
    //显示主页
    public function index(){
        //查询个人信息
        $info = $this->info();
        $this->assign('info' , $info[0]);
        //查询关注列表
        $look = $this->look();
        $js_file =array('js/info.js','/layer/layer.js','js/jQuery.rTabs.js');
        $css_name = array('css/info.css');
        $js_cont = '$(function() {
        $("#tab").rTabs();
    })';
        layout('Layout/public');
        $this->assign('title','信息中心');//模板标题
        $this->assign('css_name',$css_name);//要引入的css文件--数组
        $this->assign('js_file',$js_file);//要引入的js文件--数组
        $this->assign('js_cont',$js_cont);//需要附加的js代码
        $this->assign('data' , $look['rst']);
        $this->assign('page' , $look['page']);
        $this->display('index');
    }
    //获取信息
    private function get_info($id ,$mail){
        if ($mail){
            $where = "user.id = info.id and user.user = '$id'";
        }else{
            $where = "user.id = info.id and user.id = '$id'";
        }
        $mod = M("user");
        $rst = $mod->query("select user.id,user.user,user.name,info.sex,info.birth,info.tel,info.job from `user`,`info` where $where");
        return $rst;
    }
    //查找并显示个人信息
    protected function info(){
        $mod = new Model('info');
        $rst = $mod->where("id = '{$_SESSION[user][id]}'")->select(); //查询个人信息
        if (!$rst){  //验证是否为空
            $a['id'] = $_SESSION['user']['id'];
            $jg = $this->my_add('info', $a);  #初始化个人信息
            if (!$jg){
                $this->error('系统错误请稍后');
            }
        }
        $rst = $this->get_info($_SESSION['user']['id'],false);
//        $where = "user.id = info.id and user.id = '{$_SESSION[user][id]}'";
//        $mod = M("user");
//        $rst = $mod->query("select user.id,user.user,user.name,info.sex,info.birth,info.tel,info.job from `user`,`info` where $where");
        return $rst;
    }
    //查找显示并处理我的关注信息
    public function look(){
        $mod = new Model();
        $sql = "select user.id,user.user,user.name from look,user where user.id = look.id_u and look.id_a = {$_SESSION[user][id]}";
        $cont = count($mod->query($sql)); //查询数据 统计数目
        if ($cont < 1){ //判断结果是否为空
            return false;
        }else{
            $page = new \Think\Page($cont , 5 ); //使用分页
            $rst = $mod->query("select user.id,user.user,user.name from look,user where ( user.id = look.id_u and look.id_a = {$_SESSION[user][id]} ) limit $page->firstRow , $page->listRows");
            echo $mod->getLastSql();
            $show = $page->show();
            return array('rst'=>$rst , 'page'=> $show);
        }
    }
    //查找用户
    public function user_sel(){
        $user = htmlspecialchars($_POST['user']);
        $mod = M('user');
        $rst = $mod->field('id,name,user')->where("user = '$user' or name = '$user'")->select();
        echo $this->json_echo($rst);
    }
    //添加关注
    public function add_look(){
        if (preg_match("/^\d{1,11}$/",$_POST['user'])){
            $a['id_u'] = $_POST['user'];
            $mod = M('look');   //验证是否已经添加
            $cc = $mod->field('id_u')->where("id_a = '{$a['id_u']}'")->select();
            if ($cc[0]){
                exit(0);// 是的话直接退出
            }
            $a['id_a'] = $_SESSION['user']['id'];
            $rst = $this->my_add('look' ,$a);
            if ($rst){
                echo 1;
            }else{
                echo 0;
            }
        } else{
            exit(0);
        }
    }
    //取消关注
    public function unlook(){
        if (preg_match("/^\d{1,11}$/",$_POST['user'])){ //检测数据合法性
            $id_u = $_POST['user'];
            $id_a = $_SESSION['user']['id'];
            $mod = new Model('look');
            $mod->startTrans();
            try{
                $rst = $mod->where("id_a=$id_a AND id_u=$id_u")->delete();
            }catch (Exception $e){
                $mod->rollback();
                exit(0);
            }finally{
                if ($rst){
                    $mod->commit();
                    echo 1;
                }else{
                    $mod->rollback();
                    exit(0);
                }
            }
        } else{
            exit(0);
        }
    }
    //读取他人信息
    public function this_info(){
        if ($_GET['is'] == 'true'){
			$mail = $_GET['mail'];
            $rull = '/([\w\@.])+/';
            preg_match($rull , $mail , $rst);//处理数据
            $data = $this->get_info($rst[0] , true);
        }
        else if ($_GET['is'] == 'false'){
			$mail = base64_decode($_GET['mail']);
            if (preg_match("/^\d{1,11}$/",$mail)){
                $data = $this->get_info($mail , false);
            }else{
                $this->error("数据发生错误");
            }
        }else{
            $this->error('数据错误');
        }
        $this->assign('data' , $data[0]);
        $js_file =array('js/article.js');
        $css_name = array('css/grxx.css');
        $this->tp_layout('个人信息',$css_name,$js_file,'','info');
    }
}