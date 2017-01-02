window.vrf = false;
window.mailt=false;
window.ckmail=false;
$(document).ready(function(){
    //登录部分
    //账号验证
    $("#user").blur(function() { user() });
    //密码检测
    $("#pwd").blur(function() { pwd() });
    //验证码校验
    $("#verify").blur(function() { verify() });
    //注册部分
    //邮箱验证
    $("#mail").blur(function () { mail() });
    //昵称验证
    $("#name").blur(function () { name() });
    //获取验证验证
    $("#hq").click(function () { hq() });
    $("#rpwd").blur(function () { repwd() });
    $("#num_vrf").blur(function () { num_vrf() });
});
//倒计时按钮
function btn_time(btn) {
    var count = 30;
    var countdown = setInterval(CountDown, 1000);
    function CountDown() {
        $(btn).attr("disabled", true);
        $(btn).val(count + "秒后重新获取");
        if (count == 0) {
            $(btn).val("获取验证码").removeAttr("disabled");
            clearInterval(countdown);
        }
        count--;
    }
}
//账号验证
function user(){
    var name = $("#user").val().length;  //用户
    //检测账户
    if ( name < 5) {
        $("#user_log").html("帐号不正确");
        return false;
    } else {
        $("#user_log").html("");
        return true;
    }
}
//密码检测
function pwd(){
    var pwd = $("#pwd").val().length;    //密码
    if(pwd<5){
        $("#pwd_log").html("密码过短");
        return false;
    }else{
        $("#pwd_log").html("");
        return true;
    }
}
//验证码检测
function verify() {
    var ym = $("#verify").val();
    $.ajax({
        url:url+"/Home/Index/ck_verify",
        data: {ym : ym},
        dateType:'json',
        async:false,
        type:'post',
        success:function(msg){
            if (msg == 1) {
                $("#verify_log").html("");
                vrf = true;
            }else {
                $("#verify_log").html("验证码错误");
            }
        }
    });
}
//邮箱检测
function mail() {
    var m = $("#mail").val();
    var ru = /^([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;
    var rzt= m.match(ru);
    if(rzt==null){
        $("#mail_log").html("请填写正确邮箱");
        return;
    }else{
        $.ajax({
            url:url+"/Home/Index/mail_ext",
            data: {mail : m},
            dateType:'json',
            async:false,
            type:'post',
            success:function(msg){
                if (msg==1) {
                    $("#mail_log").html("该邮箱已注册");
                    return;
                }else {
                    $("#mail_log").html("");
                }
            }
        });
    }
}
//昵称检测
function name() {
    if($("#name").val().length <1 ){
        $("#name_log").text('昵称不能为空');
        return false;
    }else if($("#name").val().length >30 ) {
        $("#name_log").text('昵称过长');
    }else {
        $("#name_log").text('');
        return true;
    }
}
//获取验证码检测
function hq(){
    verify();
    mail();
    if(mailt && vrf){
        $("#mail").attr("readonly","readonly");
        $("#hq").attr("value","重新发送");
        $.post(url+"/Home/Index/atcmail",{mail:$("#mail").val()});
        btn_time('#hq');
    }
}
//数值验证码检测
function num_vrf() {
    var mailyzm = $("#num_vrf").val();
    if(mailyzm.length == 6){
        $.ajax({
            url: url + "/Home/Index/ck_mail_num",
            data: {vrf: mailyzm},
            dateType: 'json',
            async: false,
            type: 'post',
            success: function (msg) {
                if (msg == 1) {
                    $("#num_vrf_log").html("");
                    ckmail = true;
                } else {
                    $("#num_vrf_log").html("邮箱验证码错误");
                    ckmail = true;
                }
            }
        });
    }else {
        $("#num_vrf_log").html("邮箱验证码错误");
        return;
    }
}
//密码比对
function repwd() {
    if($("#pwd").val()!=$("#rpwd").val()){
        $("#rpwd_log").html("密码不一致");
        return false;
    }else {
        $("#rpwd_log").html("");
        return true;
    }
}
//登录处理
function login (){
    verify();
    if( user() && pwd() && vrf ){
        return true;
    }else{
        return false;
    }
}
//注册处理
function register() {
    num_vrf();
    if(ckmail && name() && pwd() && repwd() ){
        return true;
    }else{
        return false;
    }
}