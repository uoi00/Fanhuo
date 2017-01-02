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
        <div class="tab" id="tab">
    <div class="tab-nav j-tab-nav">
        <button class="btn btn-info" id="my_info" class="current">我的信息</button>
        <button class="btn btn-info" id="my_look">我的关注</button>
    </div>
    <div class="tab-con">
        <div class="j-tab-con">
            <div class="tab-con-item" style="display:block;">
                <div class="frame">
                    <div class="header">
                        <span class="tit">个人信息</span>
                        <span id="edit"><a id="edit_info" href="javascript:;">修改</a></span>
                    </div>
                    <div class="body">
                        <table>
                            <tr>
                                <td class="td1">昵称：</td><td class="td2"><?php echo ($info["name"]); ?></td>
                            </tr>
                            <tr>
                                <td class="td1">账号：</td><td class="td2"><?php echo ($info["user"]); ?></td>
                            </tr>
                            <tr>
                                <td class="td1">I D：</td><td class="td2"><?php echo ($info["id"]); ?></td>
                            </tr>
                            <tr>
                                <td class="td1">性别：</td><td class="td2"><?php echo ($info["sex"]); ?></td>
                            </tr>
                            <tr>
                                <td class="td1">生日：</td><td class="td2"><?php echo ($info["birth"]); ?></td>
                            </tr>
                            <tr>
                                <td class="td1">电话：</td><td class="td2"><?php echo ($info["tel"]); ?></td>
                            </tr>
                            <tr>
                                <td class="td1">住址：</td><td class="td2"><?php echo ($info["addr"]); ?></td>
                            </tr>
                            <tr>
                                <td class="td1">工作：</td><td class="td2"><?php echo ($info["job"]); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-con-item">
                <div class="frame">
                    <span class="tit">账号搜索</span>
                    <div class="input-group" id="sousuo">
                        <label class="input-group-addon">账号</span></label>
                        <input type="text" class="form-control" id="mail" name="mail" placeholder="昵称、邮箱">
                    </div>
                    <div id="mail_log" class="text-danger"></div>
                    <button id="sub" class="btn btn-info">提交</button>
                    <div class="tit">我的关注</div>
                    <div id="my_looks">
                        <?php if(is_array($data)): foreach($data as $key=>$vo): ?><div class='looks'>
                                <div class='looks_head'><?php echo ($vo["name"]); ?>(<?php echo ($vo["user"]); ?>)</div>
                                <div class='looks_btm' id="<?php echo ($vo["id"]); ?>">
                                    <a href='javascript:;' class="thisinfo">个人信息</a>
                                    <a href='javascript:;' class="unlook">取消关注</a>
                                </div>
                            </div><?php endforeach; endif; ?>
                        <?php echo ($page); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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