<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>用户登录</title>
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
    </style>
</head>
<body>
    <div class="col-md-4 col-xm-12 cont">
        <form id="frm" action="/Fanhuo/index.php/Home/Index/land" method="post" onsubmit="return login()">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3>登录：</h3>
                </div>
                <div class="panel-body">
                    <input type="text" name="user" id="user" class="form-control" placeholder="帐号">
                    <div id="user_log" class="text-danger"></div>
                    <br>
                    <input type="password" name="pwd" id="pwd" class="form-control" placeholder="密码">
                    <div id="pwd_log" class="text-danger"></div>
                    <br>
                    <div id="dym">
                        <div class="input-group">
                            <input type="text" id="verify" name="verify" class="form-control" placeholder="验证码">
                            <div class="input-group-addon"><img title="点击刷新" src="/Fanhuo/index.php/Home/Index/verify" align="absbottom" onclick="this.src='/Fanhuo/index.php/Home/Index/verify?'+Math.random();"/></div>
                        </div>
                        <div id="verify_log" class="text-danger"></div>
                    </div>
                    <br>
                    <input class="btn btn-block btn-success" id="sub" type="submit" value="登录">
                </div>
            </div>
            <div class="panel-footer panel-info" align="center">
                <a href="/Fanhuo/index.php/Home/Index/register" >注册帐号</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/Fanhuo/index.php/Home/Index/found" >忘记密码</a>
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