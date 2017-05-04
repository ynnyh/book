/**
 * Created by Administrator on 2017/1/12.
 */
$(document).ready(function(){
//    增
    $(".add_cats").on("click",function(){
        var url='/book/index.php/admin/add_cats';
        $.ajax({
            url:url,
            success:function(id){
                $id=JSON.parse(id);
                $(`<tr>
                        <td></td>
                        <td>
                            <input type="text" value="">
                        </td>
                        <td style="cursor:pointer">
                            <span class="glyphicon glyphicon-remove" style="color:red"></span>
                        </td>
                   </tr>`).insertAfter(".wat");
            }
        });
    });

//    删
    $(".wat").on("click",".delete_cate",function(){
        var trs=$(this).closest("tr");
        var id=trs.attr("data-id");
        trs.hide();
        var url=`/book/index.php/admin/delete_cats/aid/${id}`;
        var data={
          aid:id
        };
        $.ajax({
            url:url,
            data:data
        })
    });
//    改
    $(".wat").on("change","input:text",function(){
        var trs=$(this).closest("tr");
        var post_data={
            cate_name:trs.find("input:text").val(),
            cate_id:trs.attr("data-id")
        }
        var url='/book/index.php/admin/update_cat';
        $.ajax({
            url:url,
            type:'post',
            data:post_data,
            success:function(data){
                console.log(data);
            }
        })
    })


});