/**
 * Created by Administrator on 2017/1/12.
 */
$(document).ready(function () {
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

    //增
    $(".add").on("click", function () {
        var url = "/book/index.php/admin/add_artist";
        $.get(url).done(function (id) {
            $id = JSON.parse(id);
            $(
                `
            <div class= "col-sm-6 col-md-4" >
                <div class= "thumbnail" >
                    <div class="avarta" style="position:relative">
                        <label for= "file{$id}" style="position:absolute;top:0;left:0;width:100%;height:100%"></label>
                        <form action="" enctype="multipart/form-data">
                            <input name="file" style = "display:none" type = "file" id = "file{$id}" >
                        </form>
                        <img src="/music/static/img/1.png" alt="" class="img-circle">
                    </div>
                    <div class = "caption" >
                    <h3>
                    <input class = "form-control" type = "text" value = " " >
                </h3>
                <p>
                <input type = "radio" value = "1" name = "name{$id}" checked > 男
            <input type = "radio" value = "2" name = "name{$id}" > 女
                </p>

                <p>
                <input type = "text" value = "" >
                </p>

                <p>
                <a href = "javascript:void(0);" class = "btn btn-danger" role = "button" >
                <span class = "glyphicon glyphicon-remove" > </span>
                </a>
                </p>
                </div>
                </div>
                </div>
                `
            ).insertAfter('.add');
        })
    });

//    删
    $("#content").on("click", ".delete-btn", function () {
        var card = $(this).closest(".col-md-4");
        var id = card.attr("data-id");
        card.hide();
        var url =`/book/index.php/admin/delete_artist/aid/${id}`;
        $.ajax({
            url: url,
            success: function (data) {
                console.log(1);
            }
        });
    })

//    改
    $("#content").on("change", "input:radio,input:text", function () {
        var card = $(this).closest(".col-md-4");
        var post_data = {
            author_name : card.find(".name").val(),
            author_sex : card.find("input:radio:checked").val(),
            author_age : card.find(".age").val(),
            author_id : card.attr("data-id")
    };
        var url='/book/index.php/admin/update_artist';
        $.ajax({
            url:url,
            type:'post',
            data:post_data
        })
    });
//    图片上传与修改
    $("#content").on("change","input:file",function(){
        var formData=new FormData($(this).closest('form').get(0));
        formData.append('id',$(this).closest('.col-md-4').attr("data-id"));
        $.ajax({
            contentType:false,
            processData:false,
            url:'/book/index.php/admin/update_avarta',
            data:formData,
            type:'post',
            success:(function(src){
                $(this).closest('.thumbnail').find('img').remove();
                var src=JSON.parse(src);
                $("<img>").attr("src",src).css({width:"100%",height:"100%"}).appendTo($(this).closest(".avarta"));
            }).bind(this)
        });
    })
});