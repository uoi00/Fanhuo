window.ck = 0;
$(document).ready(function(){
    $("#btn_gts").click(function () {
        ck++;
        get_atcs(ck);
    });
    $(".btndel").click(function () {
        if(confirm("你确定删除该文章")){
            var id = $(this).attr('id');
            $.post(url+'/Home/Dmic/atc_del',{id:id},function (msg) {
                if(msg == 'yes'){
                    alert('删除成功');
                }else {
                    alert('删除失败');
                }
                window.location.href=url+'/Home/Dmic/my_atc';
            });
        }
    });
});
//处理文章
function send() {
    if( $("#titl").val().length<1 ){
        alert('文章标题不能为空!');
        return false;
    }else if( $("#titl").val().length>30 ){
        alert("标题过长!");
        return false;
    }else if($("#atc_cont").val().length>1){
        alert("文章内容不能为空!");
        return false;
    }else {
        return true;
    }
}
//查询是否有新的文章
function up_atc() {
    $.post(url+'/Home/Dmic/up_atc',{},function (msg) {

    })
}
//获取关注文章
function get_atcs(num) {
    if(num == null){
        num =0;
    }
    $.post(url+'/Home/Dmic/get_atc',{num:num},function (msg) {
        if(msg == 'null'){
            alert('没有文章咯！');
        }else {
            var a = JSON.parse(msg);
            var cld = '';
            for (i = 0; a[i]; i++) {
                var json = JSON.parse(a[i]);
                var cld = '<div class="article" id="' + json['id'] + '"> <div class="atc_head"> <div class="atc_name"><a href="javascript:;" onclick="get_info(this)" title="查看信息">' + json['uid'] + '</a></div> <div class="atc_time">' + json['ctime'] + '</div> </div> <hr> <div> <h4 class="atc_body"><a href="javascript:;" onclick="get_atc(this)" title="查看全文">' + json['title'] + '</a></h4> </div> ';
                $("#atc_frame").append(cld);
            }
        }
    });
}
//查看他人信息
function get_info(a) {
    var mail = $(a).text();
    window.open(url+'/Home/Info/this_info?mail='+mail+"&is=true");
}
//获取具体文章
function get_atc(a) {
    var id = $(a).parent().parent().parent().attr("id");
    window.open(url+'/Home/Dmic/get_cont?id='+encode64(id));
}

