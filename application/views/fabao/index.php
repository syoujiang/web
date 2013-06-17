<script type="text/javascript">
function $(id){
return document.getElementById(id);
}
window.onload=function(){
    var pan;
    var conf;
    var selectAll = $("selectAll"),
    unSelect = $("unSelect"),
    del = $("del"),
    inputs=document.getElementsByName('range[]'),
    len = inputs.length;
    selectAll.onclick=function(){
        for(var i=0; i<len;i++){
            inputs[i].checked=true;
        }
    }
    unSelect.onclick=function(){
        for(var i=0; i<len;i++){
            var o = inputs[i];
            o.checked?o.checked=false:o.checked=true;
        }
    }
 
    $("form1").onsubmit=function(){
        for(var i=0; i<len;i++){
            var o = inputs[i];
            if(o.checked){
                pan=1;
                break;
            }else{
                pan=0;
            }
        }
 
        if(!pan){
            alert("请选择");
            return false;
        }else{
            conf=confirm("确定删除");
        }
 
        if(conf){
            return true;
            }else{
                return false;
                }
    }
}
function submitForm(){
    var boxes = document.getElementsByName("range[]");  
    var groupTypeId=""; 
    for (i = 0; i < boxes.length; i++)  
    {  
        if (boxes[i].checked)  
        {  
            groupTypeId += boxes[i].value+",";  
        }
    }
    if(groupTypeId.length<1)
    {
        alert("请选择需要删除的一项");
        return false;
    }
    indexform.mymethod.value="delete";
    indexform.deleteid.value=groupTypeId;
  //  alert(indexform.deleteid.value);
    indexform.submit();
}
function searchForm(){
    indexform.mymethod.value="search";
    alert(indexform.mymethod.value);
    indexform.submit();
}
</script>
<style type="text/css">
.ctl{table-layout:fixed}
.ctl td{text-overflow:ellipsis;overflow:hidden;white-space:nowrap;padding:2px}
</style>
<?php echo $formurl; ?>
<div id="content">
  <div class="container-fluid">
  	 <legend>法宝管理</legend>
<a class="btn btn-primary" href="<?php echo site_url("fabao/create") ?>">添加</a>
<input class="btn btn-primary" type="button" value="删除" onclick="submitForm()">
<input class="btn btn-primary" type="button" value="全选" id="selectAll">
<input class="btn btn-primary" type="button" value="反选" id="unSelect">
<input type="text" class="input-medium search-query" name="searchtext" value="<?php echo $searchtext ?>"><button type="button" class="btn" onclick="searchForm()">查找</button>
<table class="table table-striped table-bordered table-condensed" class="ctl">
<tbody><tr>
<th></th>
<th>序号</th>
<th>法宝名称</th>
<th>类别</th>
<th>作者</th>
<th>语种</th>
<th>出版时间</th>
<th>推荐</th>
<th>预览</th>

</tr>
	<?php $index_id=1; ?>
<?php foreach ($news as $news_item): ?>

	<tr>
	<td>  
        <label class="checkbox">
	   <?php echo form_checkbox('range[]', $news_item['id']); ?>
	   </label>
    </td>
	<td><?php echo anchor('fabao/update/'.$news_item['id'],$index_id); $index_id++;?></td>
	<td><?php echo mb_substr($news_item['fbname'],0,10); ?></td>
	<td><?php  foreach ($news_type as $type) {
                # code...
                    if($type['id'] == $news_item['type'])
                    {
                        echo $type['fabao_type'];
                        break;
                    }
                }
        ?></td>
	<td><?php echo $news_item['auth'];?></td>
	<td><?php echo $news_item['language_type'] ?></td>
    <td><?php echo mb_substr($news_item['public_time'],0,10); ?></td>
    <td><?php
                // tuijian
                if($news_item['tuijian']) 
                {
                    echo anchor('fabao/index/off/'.$news_item['id'],"取消",array('class' => 'btn btn-small btn-primary disabled'));
                }
                else//非推荐
                {
                    echo anchor('fabao/index/on/'.$news_item['id'],"推荐",array('class' => 'btn btn-small btn-primary'));
                }
         ?>
    </td>
	<td><?php echo anchor_popup('fabao/show/'.$news_item['id'],'预览'); ?></td>
	
	</tr>
<?php endforeach ?>
</tbody>
</table>
<div class="page">
<?php echo $this->mypage->show(1); ?>
</div>
</div>
</div>
</form>