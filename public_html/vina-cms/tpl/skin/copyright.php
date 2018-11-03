<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>2016 - Designed & Powered by © - <a target="_blank" href="<?=$domain?>"><?=get_bien('title')?></a>,</strong> All rights reserved.
    <p class="support-footer">Support 24/7: <b><?=admin_company?></b> Hotline: <b><?=admin_phone?></b></p>
</footer>
<?php if(($_GET['act']=='media_gal')||($_GET['act']=='album_mana_list')){?>
<script type="text/javascript">
    $('.fancybox').fancybox({
        //closeBtn : false,
        'width': '100%',
        'autoSize': false,
        afterClose: function() {
            location.reload();
        },
    });
</script>
<?php }else{?>
    <script type="text/javascript">$('.fancybox').fancybox({
        'width': '100%',
        'autoSize': false
    });</script>
<?php } ?>
<script type="text/javascript">
$(document).load( function(){
    $('#price').number( true, 0 );
    $('#price2').number( true, 0 );
    
    
});
function setview(table,id)
{//alert("Hello!!");
    $.ajax({
        type:'GET',
        url:'<?=$domain?>/<?=admin_url?>/setview.php',
        data:{id:id,table:table},
        success:function(qq){
            $("#view_active_"+table).html(qq);
        }
                        
    });
};
$(function(){
$('#sortable').sortable({
    axis: 'xy',
    opacity: 0.5,
    cursor: 'move',
    update: function(event, ui) {
        var data_id = $(this).sortable('toArray').toString(); //get id from li
        var table = $('#table_sortable').val(); //get value table from input had #table_sortable
        $.ajax({
            url: '<?=$domain?>/<?=admin_url?>/order.php',
            type: 'POST',
            data: {list_order:data_id,table:table},
            success: function(data) {
                
            },
            complete: function(){
                window.location.reload();
            },
        });
    }
});
});
/*Keo,tha drag and drop*/
</script>

<script type="text/javascript">
    function media_select(page=''){
        var item=document.getElementById("media_items").value;
        var folder=document.getElementById("media_folder").value;
        $.ajax({
            type:"GET",
            url:"<?=$domain?>/<?=admin_url?>/ajax/media_select.php",
            data:{ folder : folder, item: item, page:page},
            dataType: 'html',
            cache: false,
            beforeSend: function() {
                $("#block-loadding").addClass("loadding");
            },
            success : function(data)
            {
                $(".block-folder-rs").html(data);
            },
            complete: function() {
                setTimeout(function () {
                    $("#block-loadding").removeClass("loadding");
                }, 300);
            },
        });
    }
    
    function media_option(event,pathdir='',custom = 'null'){ //This is Function Create, Delete, Edit Folder
        $.ajax({
            type:"GET",
            url:"<?=$domain?>/<?=admin_url?>/ajax/media_option.php",
            data: {event : event, pathdir : pathdir, custom : custom},
            dataType: 'html',
            cache: false,
            beforeSend: function(){
                $("#name-"+pathdir).parent().parent().addClass('active');
            },
            success : function(data){
            },
            complete: function(){
                
                setTimeout(function () {
                    $("#name-"+pathdir).parent().parent().removeClass("active");
                }, 1000);
            },
        });
    };
    function show_input(getClass) { // show input to display input rename folder.
        $(".show_input").not('.'+getClass +' .show_input').removeClass("active");
        $('.'+getClass +' .show_input').toggleClass("active");
    }
    function show_secret(){
        $(".block-media .block-folder-nav li span a").toggleClass("active");
    }
    function media_upload(){
        $(".block-upload-file").slideToggle();
    }
    function notify(id){ // copy input, textarea
        var $temp = $("<input />");
        $("body").append($temp);
        $temp.val($("#"+id).text()).select();
        document.execCommand("copy");
        $temp.remove();
        $("#"+id).parent().parent().addClass('active');
        setTimeout(function () {
            $("#"+id).parent().parent().removeClass("active");
        }, 1000);
    }
    
    
</script>
<script>
function uploads(){
    var form_data = new FormData();
    var ins = document.getElementById('multiFiles').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files[]", document.getElementById('multiFiles').files[x]);
    };
    var other_data = $('form').serializeArray();
    $.each(other_data,function(key,input){
        form_data.append("size",  $('#media_size option:selected').val());
        //form_data.append(select.name,option.value); print_r($_FILES)or print_r($_POST); to see result
    });
    // Lấy kết quả với new FormData() sử dụng serializeArray() hoặc files như ví dụ trên là ins
    $.ajax({
        url: "<?=$domain?>/<?=admin_url?>/ajax/media_uploads.php", // point to server-side PHP script 
        dataType: 'html', // what to expect back from the PHP script
        cache: true,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend: function(){
            $("#block-loadding").addClass("loadding");
        },
        success: function (response) {
            document.getElementById("media_items").value='';
            document.getElementById("media_folder").value='';
            $('.block-folder-rs').html(response); // display success response from the PHP script
            $("#media_selectall").removeClass("hidden");
            $("#file-reset").html('<input type="file" id="multiFiles" name="files[]" multiple="multiple" style="margin-bottom: 10px;" />');
            $("#block-loadding").removeClass("loadding");
            $('.block-upload-file').slideUp();
        },
        error: function (response) {
            $('.block-folder-rs').html(response); // display error response from the PHP script
        }
    });
}
</script>
 <script type="text/javascript"> // media into post, page...
function relationship_option( event, id, value ){
    var return_val = ''; 
    if( event == 'rename' ){
        return_val = 'data-title';
    }else if( event == 'renote' ){
        return_val = 'data-note';
    }else if( event == 'reurl' ){
        return_val = 'data-url';
    };
    $.ajax({
    type:"GET",
    url:"<?=$domain?>/<?=admin_url?>/ajax/media_relationship_option.php",
    data: {event : event, id : id, value : value},
    dataType: 'html',
    cache: false,
    success: function(data){
        $('.block-edit-'+id).attr(return_val,data);
        setTimeout(function () {
            $("#"+event).parent().addClass("active");
        }, 100);
    },
});
}

/**
* Nhập data-key tùy ý
* Dán đoạn code dưới vào vị trí muốn hiển thị Upload media
* <a class="fancybox btn btn-danger" href="#media" id="set_single" data-key='single'><i class="fa fa-cloud-upload" aria-hidden="true"></i> <span>Upload Image&hellip;</a>
* Chọn từng images -> media_submit()
*/
$('.edit-item').click(function(){
    $(".block-showfile").addClass("col-md-8").removeClass("col-md-12");
    var act         = $(this).attr('data-act');
    var id          = $(this).attr('data-id');
    var size        = $(this).attr('data-size');
    var title       = $(this).attr('data-title');
    var note        = $(this).attr("data-note");
    var image       = $(this).attr('data-image');
    var url         = $(this).attr('data-url');
    var filetype    = $(this).attr('data-filetype');
    var filetime    = $(this).attr('data-filetime');
    var filesize    = $(this).attr('data-filesize');
        $(".show-info-media").hide().html('<div class="show-info-media-bg"><a onclick="close_showfile()" class="close-showfile" href="javascript:;void(0)"><i class="fa fa-chevron-right" aria-hidden="true"></i></a><div class="box-info"> <img class="img-responsive" src="'+image+'" /><p>File size: '+filesize+'</p><p>File type: '+filetype+'</p><p>Uploaded on: '+filetime+'</p><p>Dimensions: '+size+'</p></div><div class="box"><label>Link:</label> <input style="background-color: transparent;" type="text" readonly value="'+image+'"></div><div class="box"><label>Name:</label> <input id="rename" type="text" onchange="relationship_option('+"'rename'"+','+"'"+id+"'"+',this.value)" value="'+title+'"></div><div class="box"><label>Note:</label> <textarea id="renote" rows=3 onchange="relationship_option('+"'renote'"+','+"'"+id+"'"+',this.value)" >'+note+'</textarea></div><div class="box"><label>Url:</label> <input id="reurl" type="text" onchange="relationship_option('+"'reurl'"+','+"'"+id+"'"+',this.value)" value="'+url+'"></div></div>').addClass("col-md-4").removeClass("col-md-1").fadeIn(800); 
});
function close_showfile(){
    $(".show-info-media-bg").hide().remove();
     $(".block-showfile").addClass("col-md-12").removeClass("col-md-8");
};
$('.intosub-cl').click(function(){
    var act = $(this).data('act');
    var id = $(this).data('id');
    $(".media_remove_"+act).removeClass("hidden");
    $('.'+act).find("#item-"+id).toggleClass("selected");
});
function media_submit(){ //At site need avatar. Send id and url image.
    var data_key = $("#set_single").attr("data-key");
    if(data_key =='single'){
        var id_arr      = [];
        $('.block_media').find(".intosub-cl.selected").each(function() 
        {
            var idkk  = $(this).attr("data-id");
            if (typeof idkk !== typeof undefined && idkk !== false) {
                id_arr.push(idkk);
            };
        });
        if(id_arr.length==0){
            alert('Vui lòng chọn ảnh.');
        }else if(id_arr.length>1){
            alert('Chỉ được chọn 1 ảnh làm ảnh đại diện.');
        }else{
            var id  = $('.block_media').find(".intosub-cl.selected").attr("data-id");
            var url = $('.block_media').find(".intosub-cl.selected").attr("data-url");
            var file_type = $('.block_media').find(".intosub-cl.selected").attr("data-type");
            var mine = $('.block_media').find(".intosub-cl.selected").attr("data-mine");
            var name = $('.block_media').find(".intosub-cl.selected").attr("data-name");
            if (typeof id !== typeof undefined && id !== false) {
                document.getElementById('set_id').value = id;
                //$("#set_id").val(id); //truyền id đền input site lấy ảnh
                if(mine=='image'){
                    $("#set_img").html('<img class="img-responsive" src="'+url+'" >'); //truyền src đền input site lấy ảnh
                }else{
                    $("#set_img").html('<div class="block-filetypeshow"><img class="img-responsive" src="images/file.png"><span class="block-textfile">.'+file_type+'</span><p>'+name+'</p></div>'); //truyền src đền input site lấy ảnh

                }
            }else {
                alert("Cannot get value attributes from media_submit()");
            }
            $.fancybox.close();
        }
    }else if(data_key =='multi'){
        var data_parent         = $("#set_single").attr("data-parent");
        var data_par_type       = $("#set_single").attr("data-par-type");
        var data_type           = $("#set_single").attr("data-type");
        var id_arr      = [];
        $('.block_media').find(".intosub-cl.selected").each(function() 
        {
            var id  = $(this).attr("data-id");
            if (typeof id !== typeof undefined && id !== false) {
                id_arr.push(id);
            };
        });
        $.ajax({
            type:"GET",
            url:"<?=$domain?>/<?=admin_url?>/ajax/media_upload_album.php",
            data: {id_arr : id_arr, data_parent : data_parent, data_par_type : data_par_type, data_type:data_type },
            dataType: 'html',
            cache: false,
            beforeSend: function(){
                
            },
            success : function(data){
                
            },
            complete: function(){
                window.location.reload();
            },
        });
    }
};
function remove_image(id,parent_type,type){ // remove image selected post, postcat, gallery...
    $.ajax({
        type:"GET",
        url:"<?=$domain?>/<?=admin_url?>/ajax/remove_image.php", // tùy vị trí đặt mà gọi đường dẫn tuyệt đối hoặc tương đối
        data:{ id : id, parent_type: parent_type, type : type},
        dataType: 'html',
        cache: false,
        success : function(data)
        {
            $(".media-ava").addClass('block-rs active');
        },
        complete: function() {
            setTimeout(function(){
                $("#set_img").html('<img src="images/no-img.png"/>');
            });
        },
    });
};
function media_selectall(act){ // select all to remove file
    $('.'+act).find(".intosub-cl").addClass("selected");
    $(".media_selectall_"+act).addClass("hidden");
    $(".media_cancelall_"+act).removeClass("hidden");
    $(".media_remove_"+act).removeClass("hidden");
};
function media_cancelall(act){ // select all to cancel remove file
    $('.'+act).find(".intosub-cl").removeClass("selected");
    $(".media_selectall_"+act).removeClass("hidden");
    $(".media_cancelall_"+act).addClass("hidden");
    $(".media_remove_"+act).addClass("hidden");
}
function media_remove(event=''){ // Remove element selected
    var OK = confirm("Dữ liệu sẽ bị xóa và không thể khôi phục. Bạn chắc chắn xóa?");
    if(OK){
    var id_arr = [];
     $('.block_media').find(".intosub-cl.selected").each(function() 
    {
        var id = $(this).attr("data-id");
        if (typeof id !== typeof undefined && id !== false) {
            id_arr.push(id);
        }
    });
    $.ajax({
        type:"GET",
        url:"<?=$domain?>/<?=admin_url?>/ajax/media_delete.php",
        data: {id_arr : id_arr},
        dataType: 'html',
        cache: false,
        beforeSend: function(){
             $('.block_media').find(".intosub-cl.selected").each(function() 
            {
                $(this).parent().addClass("active");
            });
        },
        success : function(data){
            
        },
        complete: function(){
             $('.block_media').find(".intosub-cl.selected").each(function() 
            {
                $(this).parent().parent().remove();
            });
            $("#media_remove, #media_cancelall").addClass("hidden");
        },
    });
    }
}
function album_remove(act){ // Remove element selected
    var OK = confirm("Dữ liệu sẽ bị xóa và không thể khôi phục. Bạn chắc chắn xóa?");
    if(OK){
    var id_arr = [];
    $('.'+act).find(".intosub-cl.selected").each(function() 
    {
        var id = $(this).attr("data-id");
        if (typeof id !== typeof undefined && id !== false) {
            id_arr.push(id);
        }
    });
    $.ajax({
        type:"GET",
        url:"<?=$domain?>/<?=admin_url?>/ajax/album_delete.php",
        data: {id_arr : id_arr},
        dataType: 'html',
        cache: false,
        beforeSend: function(){
            $('.'+act).find(".intosub-cl.selected").each(function() 
            {
                $(this).parent().addClass("active");
            });
        },
        success : function(data){
            
        },
        complete: function(){
            $('.'+act).find(".intosub-cl.selected").each(function() 
            {
                $(this).parent().parent().remove();
            });
            $("#media_remove, #media_cancelall").addClass("hidden");
        },
    });
};
}
</script>