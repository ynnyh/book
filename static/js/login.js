/**
 * Created by Administrator on 2017/2/3.
 */
$(document).ready(function(){
    //账号检测
    var timerId=null;
    $("input[name=admin]").on("keyup",function(){
        var parent=$(this).closest("li");
        var name= $.trim($(this).val());
        var that=this;
        clearTimeout(timerId);
        var url=`/book/index.php/login/check_name/y_name/${name}`;
        $.get(url).done(function(data){
            timerId=setTimeout(function(){
                parent.removeClass("has-success has-error");
                //$(that).next().remove();
                if(data['state']===200){
                    parent.addClass("has-success");
                }else{
                    parent.addClass("has-error");
                    //$(that).after(`<span>${data['e_info']}</span>`);
                }
            },500)
        })
    });

//    密码检测
    $("input[name=password]").on("keyup",function(){
        var parent=$(this).closest("li");
        var name= $.trim($(this).val());
        var length=name.length;
        var that=this;
        clearTimeout(timerId);
        var url='/book/index.php/login/check_pass';
        var post_data={
            length:length,
            value:name
        };
        $.ajax({
            url:url,
            data:post_data,
            type:'post',
            success:function(data){
                timerId=setTimeout(function(){
                    parent.removeClass("has-success has-error");
                    //$(that).next().remove();
                    if(data['state']===200){
                        parent.addClass("has-success");
                    }else{
                        parent.addClass("has-error");
                        //$(that).after(`<span>${data['e_info']}</span>`);
                    }
                },500)
            }
        });
    });

//    验证码点击
//    $(".chbox").on("click",function(){
//        var that=this;
//        $.ajax({
//            url:'/book/index.php/login/change_yan',
//            success:function(data){
//                $(that).text(data);
//            }
//        });
//        return false;
//    });

//    验证码验证
//    $("input[name=check]").on("keyup",function(){
//        var name= $.trim($(this).val());
//        var that=this;
//        clearTimeout(timerId);
//        var url='/book/index.php/login/check_yan';
//        var value=$(this).val();
//        var length=$(this).val().length;
//        var post_data={
//            value:value,
//            length:length
//        };
//        $.ajax({
//            url:url,
//            data:post_data,
//            type:'post',
//            success:function(data){
//                timerId=setTimeout(function(){
//                    $(that).removeClass("has-success has-error");
//                    $(that).next().remove();
//                    if(data['state']==200){
//                        $(that).addClass("green");
//                    }else{
//                        $(that).addClass("red");
//                        $(that).after(`<span>${data['e_info']}</span>`);
//                    }
//                },500)
//            }
//        });
//    });

//    登录验证
    $(".send").on("click",function(e){
        e.preventDefault();
        //var remember=$("input[name=remember]").prop("checked");
        var url='/book/index.php/login/check_login';
        var account=$("input[name=admin]").val();
        var password=$("input[name=password]").val();
        //var yan=$("input[name=check]").val();
        data={
            account:account,
            password:password
            //check:yan,
            //remember:remember
        };
        $.ajax({
            url:url,
            data:data,
            type:'post',
            success:function(data){
                if(data['state']==200){
                    self.location.href='/book/index.php/index/h_aboutme';
                }else{
                    window.location.reload();
                    alert(data['e_info']);
                }
            }
        })
    })



});