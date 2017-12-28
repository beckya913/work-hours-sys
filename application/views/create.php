<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>
	<?php 

				//查詢當日已有的筆數(即可得知最後一筆編號)
				$this->db->where('submit_date',date('Ymd'));
				$this->db->from('report');
				$record= $this->db->count_all_results();

			?>
			<!-- Add/Remove rows dynamiclly -->
	<script type="text/javascript">
    	$(document).ready(function() {

        	$("#add").click(function() {
          		$('#items tbody>tr:last').clone(true).insertAfter('#items tbody>tr:last');
          		$('#items tbody>tr:last').find('input:text').val('').removeAttr('id').removeClass('hasDatepicker');
                var tt= $('#items tbody>tr:last');
                var trlenth= $('#items tbody>tr').length;
                /*$('#items tbody>tr:last').find("input:text").eq(2).attr('id','project_code'+trlenth);*/
                $('.work_category',tt).attr('id','work_category'+trlenth);
                $('.sub_work_category',tt).attr('id','sub_work_category'+trlenth);
                $('.project_code',tt).attr('id','project_code'+trlenth);
                $('.project_name',tt).attr('id','project_name'+trlenth);
                $('.project_status',tt).attr('id','project_status'+trlenth);
          		$('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
          	return false;
        	});

        $("#remove").click(function() {
        	if ($('#items tbody>tr').size()>2) {
        		$('#items tbody>tr:last').remove();
        			} else { alert('表格至少要有一列');
        		};
        	});

    	});
	</script>
	<div class="container-fluid">
        <h2 class="text-center">新增紀錄</h2>
		<form action="action_create" method="POST" enctype="multipart/form-data" id="hours_submit">
<input id="add" value="新增一列" type="button" class="">
<input id="remove" value="移除最後一列" type="button" class="uk-button">
		<table id="items" class="table">
			<tbody>
   				<tr> 
         			<th>工號</th>
         			<th>姓名</th>
         			<th>類別</th>
         			<th>細項工作</th>
         			<th>日期</th>
         			<th>時數</th>
         			<th>專案代碼</th>
         			<th>備註</th>
         			<th>專案名稱</th>
         			<th>專案狀態</th>
   				</tr>
   				 <tr class="addrows">
         			<td><?php echo $_SESSION['username']; ?></td>
         			<td width="80">
         				<?php 
							$query = $this->db->get_where('user_profile', array('username'=>$_SESSION['username']));
							foreach ($query->result() as $row){ ?>
							<?php echo $row->name_tw; ?>
						<?php } ?>
					</td>
					<td>
         	<select name="work_category[]" value="<?php echo set_value('work_category[]'); ?>" id="work_category" class="form-control work_category" onchange="getsubcategory(this.id);" required>
                <option>必填</option>
<?php 
//取得類別
$query = $this->db->get('categories');
foreach ($query->result() as $row)
{ 
$cid=$row->cid;
$name=$row->name; ?>
<option value="<?php echo $cid; ?>"><?php echo $name; ?></option>  
<?php } ?>
</select>
         </td>
         <td>
         	<select name="sub_work_category[]" value="<?php echo set_value('sub_work_category[]'); ?>" id="sub_work_category" class="form-control sub_work_category" required>
                <option>必填</option>
</select>
<script type="text/javascript">

    function getsubcategory(sel){

        var NewArray= sel.replace('work_category','');
        var subworkcategory= 'sub_work_category'+NewArray;

        var category_id = {"cid" : $("#"+ sel).val()};
       
        $.ajax({
          type: "POST",
          data: category_id,
          url: "<?= base_url() ?>main/get_sub_category",

          success: function(data) {
        $('#'+subworkcategory+' option').remove();
        $.each(data, function(i, data) {
        $('#'+subworkcategory).append("<option value='" + data.item + "'>" + data.item + "</option>");
    });
        }
         });
    }

</script>

         </td>
         <td>
         	<input id="work_date" size="10" type="text" name="work_date[]" value="<?php echo set_value('work_date[]'); ?>" class="datepicker form-control" placeholder="必填" required>
         </td>
         <td>
         	<input type="text" name="work_hours[]" value="<?php echo set_value('work_hours[]'); ?>" class="form-control" size="6" placeholder="必填" required>
         </td>
         <td>
         
         	<input id="project_code" type="text" name="project_code[]" value="<?php echo set_value('project_code[]'); ?>" size="10" class="form-control project_code" onclick="selectValue(this.id)">
         <script type="text/javascript">
            function selectValue(a){
            var NewArray= a.replace('project_code','');
            /*var b= $('#items tbody>tr:last .project_name').attr('id');
            var c= $('#items tbody>tr:last .project_status').attr('id');*/
            var b= 'project_name'+NewArray;
            var c= 'project_status'+NewArray;

            // open popup window and pass field id
            window.open('<?php echo base_url("main/review_project/"); ?>'+a+'/'+b+'/'+c,'popuppage',
              'width=600,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100');
            }

                                  </script>
         </td>
         <td><input type="text" name="remark[]" value="<?php echo set_value('remark[]'); ?>" class="form-control" class="form-control"></td>
         <td><input id="project_name" type="text" name="project_name[]" value="<?php echo set_value('project_name[]'); ?>" class="form-control project_name"></td>
         <td><input id="project_status" type="text" name="project_status[]" value="<?php echo set_value('project_status[]'); ?>" class="form-control project_status" size="6"></td>
   				</tr>

</tbody>
</table>
<input type="submit" name="submit" value="送出表單" class="btn btn-primary" />
<!-- Hidden fields -->
<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
<input type="hidden" name="publish_status" value="1">
<input type="hidden" name="submit_date" value="<?php echo date('Ymd'); ?>">
<input type="hidden" name="post_num" value="<?php if ($record ==0) { 
echo "001"; //如果沒有001的紀錄，就填入001
} else { echo sprintf("%03d",$record+1); } // 不然就填入最後一筆流水號＋1} ?>">
<input type="hidden" name="report_num" 
value="<?php echo date('Ymd'); ?><?php if ($record ==0) { 
echo "001"; //如果沒有001的紀錄，就填入001
} else { echo sprintf("%03d",$record+1); } // 不然就填入最後一筆流水號＋1} ?>">
</form>
    </div>
</body>
</html>