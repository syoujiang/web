
   <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/utf8_encode.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/utf8_decode.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/base64_encode.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/base64_decode.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/uniqid.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/helper.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/swfupload/swfupload.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/swfupload.queue.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/fileprogress.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/assets/js/handlers.js'); ?>"></script>
    <script type="text/javascript">
        var swfu,swfu2;
        window.onload = function() {
            var settings = {
                flash_url : "<?php echo base_url('/bootstrap/assets/swfupload/swfupload.swf');?>",
                upload_url: "<?php echo $upload_url; ?>",
                post_params: {},
                use_query_string: false,
                file_post_name: "file",
                file_size_limit : "10 MB",
                file_types : "*.png;*.jpg;*.jpeg;*.gif",
                file_types_description: "Web Image Files",
                file_upload_limit : 100,
                file_queue_limit : 0,
                custom_settings : {
                    fileUniqIdMapping : {},
                    progressTarget : "fsUploadProgress",
                    cancelButtonId : "btnCancel"
                },
                debug: false,

                // Button Settings
                button_image_url : "<?php echo base_url('bootstrap/assets/images/XPButtonUploadText_61x22.png'); ?>",
                button_placeholder_id : "spanButtonPlaceholder1",
                button_width: 61,
                button_height: 22,

                // The event handler functions are defined in handlers.js
                file_queued_handler : fileQueued,
                file_queue_error_handler : fileQueueError,
                file_dialog_complete_handler : fileDialogComplete,
                upload_start_handler : uploadStart,
                upload_progress_handler : uploadProgress,
                upload_error_handler : uploadError,
                upload_success_handler : uploadSuccess3,
                upload_complete_handler : uploadComplete,
                queue_complete_handler : queueComplete  // Queue plugin event
        };
            var settings2 = {
            flash_url : "<?php echo base_url('bootstrap/assets/swfupload/swfupload.swf'); ?>",
            upload_url: "<?php echo $upload_url; ?>",
            post_params: {},
            use_query_string: false,
            file_post_name: "file",
            file_size_limit : "10 MB",
            file_types : "*.png;*.jpg;*.jpeg;*.gif",
            file_types_description: "Web Image Files",
            file_upload_limit : 100,
            file_queue_limit : 0,
            custom_settings : {
                fileUniqIdMapping : {},
                progressTarget : "fsUploadProgress2",
                cancelButtonId : "btnCancel2"
            },
            debug: false,

            // Button Settings
            button_image_url : "<?php echo base_url('bootstrap/assets/images/XPButtonUploadText_61x22.png'); ?>",
            button_placeholder_id : "spanButtonPlaceholder2",
            button_width: 61,
            button_height: 22,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess4,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        var settings3 = {
            flash_url : "<?php echo base_url('bootstrap/assets/swfupload/swfupload.swf'); ?>",
            upload_url: "<?php echo $upload_url; ?>",
            post_params: {},
            use_query_string: false,
            file_post_name: "file",
            file_size_limit : "10 MB",
            file_types : "*.png;*.jpg;*.jpeg;*.gif",
            file_types_description: "Web Image Files",
            file_upload_limit : 100,
            file_queue_limit : 0,
            custom_settings : {
                fileUniqIdMapping : {},
                progressTarget : "fsUploadProgress3",
                cancelButtonId : "btnCancel2"
            },
            debug: false,

            // Button Settings
            button_image_url : "<?php echo base_url('bootstrap/assets/images/XPButtonUploadText_61x22.png'); ?>",
            button_placeholder_id : "spanButtonPlaceholder3",
            button_width: 61,
            button_height: 22,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess6,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        swfu = new SWFUpload(settings);
        swfu = new SWFUpload(settings2);
        swfu = new SWFUpload(settings3);
        };
    </script>
    <script type="text/javascript">
    var $bucket = '<?php echo $bucket; ?>';
    var $upToken = '<?php echo $upToken;?>';
</script>
<script>
        var editor,editor2;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="text"]', {
                resizeType : 1,
                allowPreviewEmoticons : false,
                allowImageUpload : false,
                items : [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons', 'image', 'link'],
                afterCreate : function() { 
                    this.sync(); 
                }, 
                afterBlur:function(){ 
                    this.sync(); 
                }
            });
            editor2 = K.create('textarea[name="text2"]', {
                resizeType : 1,
                allowPreviewEmoticons : false,
                allowImageUpload : false,
                items : [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons', 'image', 'link'],
                afterCreate : function() { 
                    this.sync(); 
                }, 
                afterBlur:function(){ 
                    this.sync(); 
                }
            });
            var groupTypeId=""; 
            K('input[name=getText]').click(function(e) {
                    myform.mingxi_phone.value=editor.text();
                    myform.gongde_phone.value=editor2.text();
                    $('#pic_list3 li input').each(function(index,val){
                        groupTypeId += this.value+"|";  
                    })
                    myform.huodong_pic.value =(groupTypeId); 
                    myform.submit();
                });
        });
        $(document).ready(function(){
            var postData = {
                "action": "getPic",
                "id": <?php echo $news_id ?>,
            };
            // 通过AJAX异步向网站业务服务器POST数据
            $.ajax({
                type: "POST",
                url: '../callback',
                processData: true,
                data: postData,
                dataType: "json",
                beforeSend: function(){},
                complete: function(xhr, textStatus){
                    if((xhr.readyState ==4) &&(xhr.status ==200))
                    {
                        var objs = JSON.parse(xhr.responseText);
                        for(var i=0;i<objs.data.length;i++)
                        {
                        //    alert(objs.data[i].file_key);
                            addImage6(objs.data[i].id,objs.data[i].file_key,objs.data[i].file_name,0);
                        }                      
                    }
                },
                success:function(resp){
                }
            });
        });

</script>
<div id="content">
    <?php echo validation_errors(); ?>
    <?php 
    $attributes = array('name' => 'myform');
    echo form_open('huodong/commit/update',$attributes);
    echo form_hidden('news_id',$id);  ?>
    <input type="hidden" name="sum_picture_id" value="<?php echo $mingxi_url ?>">
    <input type="hidden" name="sum_picture_fkey" value="<?php echo $mingxi_fkey ?>">
    <input type="hidden" name="sum_picture_fname" value="<?php echo $mingxi_fname ?>">
    <input type="hidden" name="con_picture_id" value="<?php echo $gongde_url ?>">
    <input type="hidden" name="con_picture_fkey" value="<?php echo $gongde_fkey ?>">
    <input type="hidden" name="con_picture_fname" value="<?php echo $gongde_fname ?>">
    <input type="hidden" name="mingxi_phone" value="<?php echo $mingxi_phone ?>">
    <input type="hidden" name="gongde_phone" value="<?php echo $gongde_phone ?>">
    <input type="hidden" name="huodong_pic" value="">
    <div class="container-fluid">
        <legend>修改活动详情</legend>
        <table class="table table-striped">  
        <thead>  
            <tr>  
                <th><label class="control-label" for="input01">选择活动</label></th>  
                <th>
                <?php 
                $options = array();
                foreach ($gonggao as $value) {
                # code...
                    $options[$value['id']]=$value['title'];
                }
                echo form_dropdown('shirts', $options, $gg_id);
                ?>
            </th>  
            </tr>  
        </thead>  
        <tbody>  
         <tr>  
            <td><label class="control-label" for="input01">投入基金</label></td>  
            <th><input type="input" name="jijin" value="<?php echo $jijin ?>"/></th>  
        </tr>  
              <tr>  
            <td><label class="control-label" for="input01">放生明细</label></td>  
            <td><textarea style="width:700px;height:200px;visibility:hidden;" name="text"><?php echo $mingxi ?></textarea></td>  
        </tr> 
        <tr>  
            <td><label class="control-label" for="input01">上传放生明细</label></td>  
            <td>        
                <form id="form1" action="index.php" method="post" enctype="multipart/form-data">
                <div class="fieldset flash" id="fsUploadProgress">
                </div>


                <div style="padding-left: 5px;">
                <span id="spanButtonPlaceholder1"></span>
                <input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
                </div>
                </form>
            </td>  
        </tr>
                      <tr>  
            <td><label class="control-label" for="input01">功德回向</label></td>  
            <td><textarea style="width:700px;height:200px;visibility:hidden;" name="text2"><?php echo $gongde ?></textarea></td>  
        </tr> 
        <tr>  
            <td><label class="control-label" for="input01">上传功德回向明细</label></td>  
            <td>        
                <form id="form2" action="index.php" method="post" enctype="multipart/form-data">
                <div class="fieldset flash" id="fsUploadProgress2">
                </div>
                <div style="padding-left: 5px;">
                <span id="spanButtonPlaceholder2"></span>
                <input id="btnCancel2" type="button" value="Cancel All Uploads" onclick="swfu2.cancelQueue();" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
                </div>
                </form>
            </td>  
        </tr>
        <tr>  
            <td><label class="control-label" for="input01">上传活动照片，最多10张</label></td>  
            <td>        
                <form id="form3" action="index.php" method="post" enctype="multipart/form-data">
                <div class="fieldset flash" id="fsUploadProgress3">
                </div>
                <div style="padding-left: 5px;">
                <span id="spanButtonPlaceholder3"></span>
                <input id="btnCancel3" type="button" value="Cancel All Uploads" onclick="swfu2.cancelQueue();" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
                </div>
                <div id="divMsg2"></div>
                <div id="thumbnails3">
                    <ul id="pic_list3" style="margin:5px;list-style:none;"></ul>
                </div>
                </form>
            </td>  
        </tr>
        <tr>  
            <td></td>  
            <td><input type="button" name="getText" class="btn" value="创建"></td>  
        </tr>  
        </tbody>  
        </table>    
    </div>
</div>

