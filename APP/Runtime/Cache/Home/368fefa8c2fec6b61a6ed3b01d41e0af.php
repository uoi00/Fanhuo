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
        <div class=".atc">
    <div class="atc_head">
        <div class="atc_tit">
            <?php echo ($data["title"]); ?>
        </div>
        <div class="atc_date">
            <?php echo ($data["ctime"]); ?>
        </div>
    </div>
    <div class="atc_cont">
        <?php echo ($data["body"]); ?>
    </div>
    <div class="atc_btm" id="<?php echo ($data["id"]); ?>">
        <a class="atc_a" title="赞一个" href="#"><?php echo ($data["care"]); ?></a>
        <a class="atc_a" href="#">转发</a>
        <a class="atc_a" href="#">评论</a>
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