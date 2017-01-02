<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="/Fanhuo/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Fanhuo/Public/css/public.css" rel="stylesheet">
    <?php foreach($css_name as $val){ echo "<link href='/Fanhuo/Public/$val' rel='stylesheet'>"; } ?>
</head>
<body>
<div class="cont">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand" style="padding:0;"><img class="logo" src="/Fanhuo/Public/img/logo.jpeg" alt="梵火空间"></a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right" style="margin-top:0">
                    <li><p id="username">欢迎回来:<br><?php echo ($user); ?></p></li>
                    <li><a href="/Fanhuo/index.php/Home/Dmic/index"> 动态中心 </a></li>
                    <li><a href="/Fanhuo/index.php/Home/News/index"> 消息中心 </a></li>
                    <li><a href="/Fanhuo/index.php/Home/Info/index"> 信息中心 </a></li>
                    <li><a href="/Fanhuo/index.php/Home/Cont/desc">退出</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <img class="bner" src="/Fanhuo/Public/img/baner.jpg">
    </div>
    <div class="col-md-10 col-xm-12 main">
        <h3>个人信息</h3>
<div align="center">
    <table align="center">
        <tr>
            <td class="td1">昵称:</td><td class="td2"><?php echo ($data["name"]); ?></td>
            <td class="td1">账号:</td><td class="td2"><?php echo ($data["user"]); ?></td>
        </tr>
        <tr>
            <td class="td1">I D:</td><td class="td2"><?php echo ($data["id"]); ?></td>
        </tr>
        <tr>
            <td class="td1">性别:</td><td class="td2"><?php echo ($data["sex"]); ?></td>
            <td class="td1">生日:</td><td class="td2"><?php echo ($data["birth"]); ?></td>
        </tr>
        <tr>
            <td class="td1">电话:</td><td class="td2"><?php echo ($data["tel"]); ?></td>
            <td class="td1">住址:</td><td class="td2"><?php echo ($data["addr"]); ?></td>
        </tr>
        <tr>
            <td class="td1">工作:</td><td class="td2"><?php echo ($data["job"]); ?></td>
        </tr>
    </table>
</div>
    </div>
    <div id="atc_dz"> </div>
    <footer class="footer">
        @所有权归 混·魂 所有
    </footer>
</div>
</body>
<script src="/Fanhuo/Public/js/jquery-1.12.3.min.js"></script>
<script src="/Fanhuo/Public/js/base64.js"></script>
<?php foreach($js_file as $val){ echo "<script type='text/javascript' src='/Fanhuo/Public/$val'></script>"; } ?>
<script type="text/javascript" src="/Fanhuo/Public/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var url="/Fanhuo/index.php";
    <?php echo ($js_cont); ?>
</script>
</html>