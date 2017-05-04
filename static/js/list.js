/**
 * Created by Administrator on 2017/1/13.
 */
$(document).ready(function(){
    var cates=[];
    //增
    $.get('/book/index.php/admin/get_category').done(function(data){
        var data=JSON.parse(data);
        cates=data;
    });
    $(".add").on("click",function(){
        $.get('/book/index.php/admin/add_list').done(function(id){
            var id=JSON.parse(id);
            console.log(id);
            var el=$(
            `
            <div class="media cont" style="position:relative">
                <a class="media-left" href="javascript:void(0);" style="position:relative">
                <label for="file${id}" style="position:absolute;top:0;left:0;width:100%;height:100%"></label>
                <form enctype="multipart/form-data">
                <input style="display:none" type="file" name="file" id="file${id}">
                </form>
                <img width="80" height="80" src="/music/static/img/1.png" alt="" class="img-circle">
                </a>
                <div class="media-body">
                <dl class="dl-horizontal">
                <dt>书名</dt>
                <dd><input type="text" class="input-sm" value=""></dd>
                <div class="tips"></div>
                <dt>类别</dt>
                <dd>
                <select class="form-control"></select>
                </dd>
                <dt>简介</dt>
                <dt></dt>
                </dl>
                </div>
                <div class="right btn-danger glyphicon glyphicon-remove" style="position:absolute;top:0;bottom:0;right:0;width:40px;height:40px;border-radius:50%;margin:auto;text-align:center;line-height:40px;cursor:pointer">
                </div>
            `
            );
            el.insertAfter($(".add"));
            $.each(cates,function(i,v){
                console.log(1);
                $(`<option value='${v.id}'>${v.name}</option>`).appendTo(el.find("select"));
            })
        });



    })

//    改
    var content=$(".content");
    content.on("change","input:text,select",function(){
        var card=$(this).closest(".cont");
        var post_data={
            list_id:card.attr("data_id"),
            list_name:card.find(".list_name").val(),
            cate_id:card.find("option:selected").val()
        };
        var url="/book/index.php/admin/update_list";
        $.ajax({
            url:url,
            data:post_data,
            type:'post'
        })
    });

//    删
    $(".content").on("click",".right",function(){
        var card=$(this).closest(".cont");
        card.hide();
        var id=card.attr("data_id");
        var url=`/book/index.php/admin/delete_list/aid/${id}`;
        $.ajax({
            url:url
        })
    })
//    上传修改小分类封面
    $(".content").on("change","input:file",function(){
        var card=$(this).closest(".cont");
        var form=$(this).closest("form").get(0);
        var formData=new FormData(form);
        formData.append('id',card.attr("data_id"));
        console.log(formData);
        $.ajax({
            url:'/book/index.php/admin/update_pic',
            processData:false,
            contentType:false,
            type:'post',
            data:formData,
            success:(function(src){
                card.find("img").remove();
                var src=JSON.parse(src);
                $("<img>").attr("src",src).css({width:'80px',height:"80px",borderRadius:"50%"}).appendTo(card.find(".media-left"));
            }).bind(this)
        });
    })

    //进度条
    var progress=$(".progress .active");
    $(document).ajaxStart(function(){
        progress.show().animate({width:'30%'});
    });
    $(document).ajaxSend(function(){
        progress.animate({width:'80%'});
    });
    $(document).ajaxSuccess(function(){
        progress.animate({width:'100%'});
    });
    $(document).ajaxComplete(function(){
        progress.delay(500).queue(function(){
            $(this).hide().animate({width:'0'}).dequeue();
        })
    });

});