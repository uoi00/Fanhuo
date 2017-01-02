<?php
namespace Home\Controller;
use Think\Exception;
use Think\Model;

session_start();//开启session
class DmicController extends ContController {
    //显示主页
    public function index(){
        $js_file =array('js/article.js');
        $css_name = array('css/hydt.css');
        $js_cont = 'get_atcs(null);';
        $this->tp_layout('好友动态',$css_name,$js_file,$js_cont,'index');
    }
    //显示文章发表页
    public function article(){
        $js_file =array('js/article.js','kinde/kindeditor-min.js','/kinde/lang/zh_CN.js');
        $css_name = array('css/hydt.css','/kinde/themes/default/default.css');
        $js_cont = 'var editor;
    KindEditor.ready(function(K) {
        editor = K.create(\'textarea[name="kcontent"]\', {
            allowFileManager : true
        });
    });';
        $this->tp_layout('文章发表',$css_name,$js_file,$js_cont,'article');
    }
    //显示相册发表页
    public function photo(){
//        $this->display('photo');
    }
    public function send(){
        $a['uid'] = $_SESSION['user']['id'];
        $a['title'] = htmlspecialchars($_POST['titl']);
        $a['type'] = $_POST['type'];
        $a['body'] = htmlspecialchars($_POST['kcontent']);
        $a['ctime'] = date("Y-m-d h:i:s");
        $rst = $this->my_add('article' , $a);
        if ($rst ){
            $this->success('添加成功，请稍候',__APP__.'/Home/Dmic/index','1');
        }else{
            $this->error('发生错误');
        }
    }
    //查询是否有新的文章更新
    public function up_atc(){

    }
    //获取关注文章
    public function get_atc(){
        $num = $_POST['num']*5;
        $look = $this->my_look();  //获取关注信息
        $where = 'uid='.$_SESSION['user']['id'];
        foreach ($look as $val){
            $where =$where . ' or uid= '. $val;
        }
        $mod = M('article');
        $rst = $mod->field('id,uid,title,body,ctime,care')->where("$where")->limit("$num,5")->order('ctime desc')->select();
        foreach ($rst as $k=>$val){
            if (!$val){
                exit('null');
            }
            $rst[$k]['uid'] = $this->id_name($val['uid']);
            $rst[$k]['body'] = html_entity_decode($rst[$k]['body']);
        }
        echo $this->json_echo($rst);
    }
    //查看文章详情
    public function get_cont(){
        $id = base64_decode($_GET['id']);
        if (preg_match("/^\d{1,11}$/" , $id)) { //检测数据合法性
            echo $id;
            $mod = M('article');
            $rst = $mod->field('id ,title,body,ctime,care')->where("id=$id")->select();
            foreach ($rst as $k=>$val){
                $rst[$k]['body'] = html_entity_decode($rst[$k]['body']);
            }
            $this->assign('data',$rst[0]);
            $js_file =array('js/article.js');
            $css_name = array('css/wzxq.css');
            $this->tp_layout('文章详情',$css_name,$js_file,'','artcles');
        }else{
            $this->error('发生错误');
        }
    }
    //查看 管理 我的文章
    public function my_atc(){
        $mod = M('article');
        $rst = $mod->field('id ,title,body,ctime')->where("uid={$_SESSION[user][id]}")->order('ctime desc')->select();
        foreach ($rst as $k=>$val){
            $rst[$k]['body'] = html_entity_decode($rst[$k]['body']);
        }
        $this->assign('data',$rst);
        $js_file =array('js/article.js');
        $css_name = array('css/hydt.css');
        $this->tp_layout('我的文章',$css_name,$js_file,'','myatc');
    }
    //删除文章
    public function atc_del() {
        $id = $_POST['id'];
        $mod = new Model('article');
        $mod->startTrans();
        try{
            $rst = $mod->where("id = $id")->delete();
            var_dump($rst);
        }catch (Exception $e){
            exit('null');
        }finally{
            if ($rst){
                echo 'yes';
            }else{
                exit('null');
            }
        }
    }
}