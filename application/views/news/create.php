  <link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>res/uploadify.css" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
 <script type="text/javascript" src="<?php echo site_url() ?>res/jquery.uploadify-3.1.min.js"></script>
  <script type='text/javascript' >
    $(function() {
     $('#upload_btn').uploadify({
      'debug'   : false,

      'swf'   : '<?php echo site_url() ?>res/uploadify.swf',
      'uploader'  : 'http://up.qiniu.com/',
      'cancelImage' : '<?php echo site_url() ?>res/uploadify-cancel.png',
      'queueID'  : 'file-queue',
      'buttonClass'  : 'button',
      'buttonText' : "Upload Files",
      'multi'   : false,
      'auto'   : true,

      'fileTypeExts' : '*.jpg; *.png; *.gif; *.PNG; *.JPG; *.GIF;',
      'fileTypeDesc' : 'Image Files',

      'method'  : 'post',
      'fileObjName' : 'file',
      'formData'  : {'token' : '<?php echo $upToken;?>'},

      'queueSizeLimit': 40,
      'simUploadLimit': 1,
      'sizeLimit'  : 10240000,
      'onUploadSuccess' : function(file, data, response) {   
      var objs=JSON.parse(data);
      alert(objs.hash);
      var postData = {
        "action": "insert",
        "file_key": objs.hash
      };

      // 通过AJAX异步向网站业务服务器POST数据
        $.ajax({
          type: "POST",
          url: '<?php echo $callback_path ?>',
          processData: true,
          data: postData,
          dataType: "json",
          beforeSend: function(){},
          complete: function(xhr, textStatus){
            alert(xhr.readyState);
            if(xhr.readyState ==4)
            {
                alert(xhr.status);
              if(xhr.status ==200)
              {
                var obj=JSON.parse(xhr.responseText);
                alert(obj.preview);
                alert(obj.deleteurl);
                $('#theDiv').prepend('<img id="theImg" src='+obj.preview+' />')
              }
            }
          },
          success:function(resp){
          }
        });   

      }, 
      'onComplete': function(event,queueID,fileObj,response,data) { 
        alert("sdfasdfas");
      },
      'onError'          : function(event, queueID, fileObj)  
      {   
        alert("文件:" + fileObj.name + " 上传失败");   
      }
        });

     });
    </script>
  <script>
        var editor,editor2;
        KindEditor.ready(function(K) {
            editor2 = K.create('textarea[name="text"]', {
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
            K('input[name=getText]').click(function(e) {
                    myform.zx_content_phone.value=editor2.text();
                    myform.submit();
                });
        });
</script>
<div id="content">
	<?php echo validation_errors(); ?>
	<?php 
    $attributes = array('name' => 'myform');
    echo form_open('news/create',$attributes); ?>
    <input type="hidden" name="sum_picture_id" value="">
    <input type="hidden" name="sum_picture_fkey" value="">
    <input type="hidden" name="sum_picture_fname" value="">
    <input type="hidden" name="con_picture_id" value="">
    <input type="hidden" name="con_picture_fkey" value="">
    <input type="hidden" name="con_picture_fname" value="">
    <input type="hidden" name="zx_content_phone" value="">
	<div class="container-fluid">
        <legend>添加新的资讯</legend>
        <table class="table table-striped">  
        <thead>  
            <tr>  
                <th><label class="control-label" for="input01">标题</label></th>  
                <th><input type="input" name="title" /></th>  
            </tr>  
        </thead>  
        <tbody>  
            <tr>  
                <td><label class="control-label" for="input01">类别</label></td>  
                <td>        
                <?php 
                $options = array();
                foreach ($news_type as $value) {
                # code...
                $options[$value['id']]=$value['news_type'];
                }
                echo form_dropdown('shirts', $options, 'large');
                ?>
                </td>  
            </tr>  
        <tr>  
            <td><label class="control-label" for="input01">摘要</label></td>  
            <td><textarea name="zx_summary"></textarea></td>  
        </tr>  
        <tr>  
            <td>上传摘要图片</td>  
            <td>
                <table class="table">
                <div id="theDiv"></div>
                <!-- <a href=""><i class="icon-trash"></i> Delete</a> -->
                 </table>

                <div class="uploadify-queue" id="file-queue"></div>
                <input type="file" name="file" id="upload_btn" />    
          
            </td>  
        </tr>
        <tr>  
            <td><label class="control-label" for="input01">内容</label></td>  
            <td><textarea style="width:700px;height:200px;visibility:hidden;" name="text"></textarea></td>  
        </tr> 
        <tr>  
            <td><label class="control-label" for="input01">来源</label></td>  
            <td><input type="input" name="zx_from" /></td>  
        </tr> 
        <tr>  
            <td><label class="control-label" for="input01">上传图片</label></td>  
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
            <td></td>  
            <td><input type="button" name="getText" class="btn" value="创建"></td>  
        </tr>  
        </tbody>  
        </table>  	
	</div>
</div>

