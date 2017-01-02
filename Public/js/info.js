$(document).ready(function(){
    $("#sub").click(function() { user_sel()}); //查找用户
    $(".thisinfo").click(function () {
        var id = encode64($(this).parent().attr("id"));
        window.open(url+'/Home/Info/this_info?mail='+id +"&is=false");
    });
});
//搜索查找用户
function user_sel() {
    var user = $("#mail").val();
    if (user == '') {
        $("#mail_log").text('查找内容不能为空');
    }else {
        $.post(url + '/Home/Info/user_sel',{user:user},function (msg) {
            var a = JSON.parse(msg);
            var cld = '';
            for(i=0;a[i];i++) {
                var json = JSON.parse(a[i]);
                cld = cld + "<div class='looks'> <div class='looks_head'>"+json['name']+'('+json['user']+")"+ "</div> <div class='looks_btm'> <a href='javascript:;' onclick='this_info("+json['id']+")'>查看信息</a> <a href='javascript:;' onclick='this_look("+json['id'] +")'>关注他</a> </div> </div>";
            }
            layer.open({
                type: 1,
                // skin: 'layui-layer-rim', //加上边框
                area: ['600px', '320px'], //宽高
                content: cld ,
            });
        });
    }
}
//查询目标用户的信息
function this_info(num) {
    console.log(num + '信息查询中...');
}
//关注用户
function this_look(num) {
    $.post(url+'/Home/Info/add_look',{user:num},function (msg) {
        if (msg ==1){
            alert('添加成功');
            window.location.href = url+'/Home/Info/index';
        }else {
            alert('添加失败');
            window.location.href = url+'/Home/Info/index';
        }
    });
}
//取消关注用户
function this_unlook(num) {
    $.post(url+'/Home/Info/unlook',{user:num},function (msg) {
        if (msg ==1){
            alert('操作成功');
            window.location.href = url+'/Home/Info/index';
        }else {
            alert('发生错误');
            window.location.href = url+'/Home/Info/index';
        }
    });
}