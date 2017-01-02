<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;
use Think\Verify;
use Think\Model;
session_start();
class IndexController extends Controller {
    //储存用户注册信息
    private function rgst_save($user ,$pwd ,$date ,$name){
        $data['user'] = $user;
        $data['pwd'] = $pwd;
        $data['ctime'] = $date;
        $data['name'] = $name;
        try {
            $mod =new Model('user');
            $mod->startTrans();
            $rst = $mod->data($data)->add();
        }catch (Exception $e){
            $mod->rollback();
            $this->error('发生错误');
        }finally{
            if ($rst === false ){
				$mod->rollback();
				$this->error('发生错误');
			}else{
				$mod->commit();
				$this->success('注册成功，请稍候',__APP__.'/Home/Index/index','1');
			}
        }
    }
    //显示验证码
    public function verify(){
        $config =array('fontSize'    =>    30,    // 验证码字体大小
            'imageW'    =>  120,
            'imageH'    =>  35,
            'fontSize'  =>  18,
            'length'      =>  4,     // 验证码位数
            'useCurve'  =>  false,
            'reset'     =>  false,
        );
        $Verify = new Verify($config);
        $Verify->entry();
    }
    //校验验证码
    public function ck_verify(){
        $Verify =     new \Think\Verify();
        if($Verify->check($_POST['ym'])){
            echo 1;
        }
    }
    private function mail_exts($mail){
        $mod=M("user");
        $u["user"]=$mail;
        $a=$mod->where($u)->select();
        return $a;
    }
    //检测注册邮箱是否存在
    public function mail_ext(){
        $a=$this->mail_exts($_POST["mail"]);
        if($a){
            echo 1;
        }
    }
    //发送注册邮件
    public function atcmail(){
        $code = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        $_SESSION['code'] = $code;
        $body="请将以下验证码输入注册页面激活账户:".$code.'；请妥善保管该验证码，勿轻易交给他人。';
        $rr = sendmail($_POST["mail"],'帐号激活',$body);
		var_dump($rr);
        //SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting
    }
    //邮箱验证码校验
    public function ck_mail_num(){
        $vrf = $_POST['vrf'];
        if ($_SESSION['code'] == $vrf){
            echo 1;
        }
    }
    //显示登录页面
    public function index(){
        $this->display('index');
    }
    //显示注册页面
    public function register(){
        $this->display('register');
    }

    //登录处理
    public function land(){
        $Verify =     new \Think\Verify();
        if ($Verify->check($_POST['verify'])) {
            $user = htmlspecialchars($_POST['user']);
            $pwd = sha1($_POST['pwd']);
            $mod = M('user');
            $rst = $mod->field('id,name,pwd')->where("user = '$user'")->select();
            if ($rst[0]['pwd'] = $pwd){
                $inf['id'] = $rst[0]['id'];
                $inf['name'] = $rst[0]['name'];
                $_SESSION['user'] = $inf;
                $this->success('登录成功<br>信息加载中...',__APP__.'/Home/Dmic/index','1');
            }else{
                $this->error('密码错误..',__APP__.'Home/Index/index',3);
            }
        }else{
            $this->error('错误信息');
        }
    }
    //注册处理
    public function regist(){
        $user = htmlspecialchars($_POST['mail']);
        $pwd = sha1($_POST['pwd']);
        $date = date("Y-m-d h:i:s");
        $name = htmlspecialchars($_POST['name']);
        if ($_POST['pwd'] == $_POST['rpwd']){
            if($_POST['num_vrf'] == $_SESSION['code']){
                unset($_SESSION['code']);
                //保存信息
                $this->rgst_save($user ,$pwd , $date , $name);
            }else{
                $this->error('信息错误');
            }
        }else{
            $this->error('信息错误');
        }
    }
}