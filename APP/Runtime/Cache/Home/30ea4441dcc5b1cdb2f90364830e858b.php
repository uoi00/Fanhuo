<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>账号注册</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="/Fanhuo/Public/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        html {font-size:62.5%}
        *{
            margin: 0%;
            padding: 0%;
        }
        .cont{
            float: none;
            display: block;
            margin-top: 5%;
            margin-left: auto;
            margin-right: auto;
        }
        .grp{
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<span class="icon-book"></span>
<div class="cont col-md-6 col-xm-12">
    <form action="/Fanhuo/index.php/Home/Index/regist" method="post" id="frm" onsubmit="return register()">
        <div class="panel-heading">
            <h3>注册：</h3>
        </div>
        <div class="panel-body">
            <div class="grp">
                <div class="input-group">
                    <label class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></label>
                    <input type="text" class="form-control" id="mail" name="mail" placeholder="邮箱">
                </div>
                <div id="mail_log" class="text-danger"></div>
            </div>
            <div class="grp">
                <div class="input-group">
                    <input type="text" id="verify" name="verify" class="form-control" placeholder="验证码">
                    <span class="input-group-addon"><img  title="点击刷新" src="/Fanhuo/index.php/Home/Index/verify" align="absbottom" onclick="this.src='/Fanhuo/index.php/Home/Index/verify?'+Math.random();"/></span>
                </div>
                <div id="verify_log" class="text-danger"></div>
            </div>
            <div class="grp">
                <div class="input-group">
                    <input type="text" id="num_vrf" name="num_vrf" class="form-control" placeholder="填入获取的验证码">
                    <span class="input-group-addon"><input type="button" id="hq" class="btn btn-info" value="获取验证码"></span>
                </div>
                <div id="num_vrf_log" class="text-danger"></div>
            </div>
            <div class="grp">
                <div class="input-group">
                    <label class="input-group-addon"><span class="glyphicon glyphicon-user"></span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="昵称">
                </div>
                <div id="name_log" class="text-danger"></div>
            </div>
            <div class="grp">
                <div class="input-group">
                    <label class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></label>
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="密码">
                </div>
                <span id="pwd_log" class="text-danger"></span>
            </div>
            <div class="grp">
                <div class="input-group">
                    <label class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></label>
                    <input type="password" class="form-control" id="rpwd" name="rpwd" placeholder="重复密码">
                </div>
                <div id="rpwd_log" class="text-danger"></div>
            </div>
            <input class="btn btn-block btn-success" type="submit" id="sub" value="提交">
        </div>
    </form>
</div>
</body>
<script src="/Fanhuo/Public/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="/Fanhuo/Public/js/login.js"></script>
<script type="text/javascript">
    var url="/Fanhuo/index.php";
</script>
</html>