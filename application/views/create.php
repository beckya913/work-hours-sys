<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>
    <script type="text/javascript">// Enable date picker
         $(function() {
            $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            endDate: "today",
            maxDate: "today"});
        
          });
    </script>
	<!-- 新增/移除表格列數 -->
	<script type="text/javascript">
    	$(document).ready(function() {

        	$("#add").click(function() {
          		$('#items tbody>tr:last').clone(true).insertAfter('#items tbody>tr:last');
          		$('#items tbody>tr:last').find('input:text').val('').removeAttr('id').removeClass('hasDatepicker');
                var tt= $('#items tbody>tr:last');
                var trlenth= $('#items tbody>tr').length;
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

    <!--新增記錄表單-->
		<form data-toggle="validator" role="form" action="action_create" method="POST" enctype="multipart/form-data" id="hours_submit">
            <input id="add" value="新增一列" type="button" class="btn btn-default">
            <input id="remove" value="移除最後一列" type="button" class="btn btn-default">
		    <table id="items" class="table">
			<tbody>
   				<tr> 
              <!--顯示姓名與工號
         			<th>工號</th>
         			<th>姓名</th>-->
         			<th>類別</th>
         			<th>細項工作</th>
         			<th>日期</th>
         			<th>時數</th>
         			<th>專案代碼</th>
         			<th>專案名稱</th>
         			<th style="display: none;">專案狀態</th>
              <th>備註</th>
   				</tr>
   				<tr class="addrows">
              <!--顯示姓名與工號
         			<td><?php echo $_SESSION['username']; ?></td>
              <?php 
              $query = $this->db->get_where('user_profile', array('username'=>$_SESSION['username']));
              foreach ($query->result() as $row){ 
                $name_tw= $row->name_tw;
                $division= $row->division;
              }?>
         			<td width="80">
         			<?php echo $name_tw; ?>
					</td>-->
				<td>
                    <div class="form-group">
         	        <select name="work_category[]" value="<?php echo set_value('work_category[]'); ?>" id="work_category" class="form-control work_category" onchange="getsubcategory(this.id);" required>
                    <option>必填</option>
                        <?php 
                        $query = $this->db->get('categories');
                        foreach ($query->result() as $row){ 
                        $cid=$row->cid;
                        $name=$row->name; 
                        ?>
                    <option value="<?php echo $cid; ?>"><?php echo $name; ?></option>  
                        <?php } ?>
                        
                    </select>
                    </div>
                </td>
                <td>
         	        <select name="sub_work_category[]" value="<?php echo set_value('sub_work_category[]'); ?>" id="sub_work_category" class="form-control sub_work_category" required>
                    <option>請選擇</option>
                    </select>
                    <script type="text/javascript">//依據類別，載入相關的工作細項
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
                                            $('#'+subworkcategory).append("<option value='" + data.id + "'>" + data.item + "</option>");
                                        });
                                    }
                                });
                            }
                    </script>
                </td>
                <td>
                    <div class="form-group">
         	        <input id="work_date" size="10" type="text" name="work_date[]" value="<?php echo set_value('work_date[]'); ?>" class="datepicker form-control" placeholder="必填" data-error="日期未填" required>
                    <div class="help-block with-errors"></div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
         	        <input type="text" name="work_hours[]" value="<?php echo set_value('work_hours[]'); ?>" class="form-control" size="1" placeholder="必填" data-error="時數未填" required>
                    <div class="help-block with-errors"></div>
                    </div>
                </td>
                <td>
                  <div class="form-group">
         	        <input id="project_code" type="text" name="project_code[]" value="<?php echo set_value('project_code[]'); ?>" size="10" class="form-control project_code" onclick="selectValue(this.id)" placeholder="必填" data-error="代碼未填" required readonly>
                  <div class="help-block with-errors"></div>
                    <script type="text/javascript">
                            function selectValue(a){
                                var NewArray= a.replace('project_code','');
                                var b= 'project_name'+NewArray;
                                var c= 'project_status'+NewArray;
                                // open popup window and pass field id
                                window.open('<?php echo base_url("main/review_project/"); ?>'+a+'/'+b+'/'+c,'popuppage',
              'width=600,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100');
            }

                    </script>
                    </div>
                </td>
                <td>
                    <input id="project_name" type="text" name="project_name[]" value="<?php echo set_value('project_name[]'); ?>" class="form-control project_name" placeholder="必填" readonly>
                </td>
                <td style="display: none;">
                    <input id="project_status" type="text" name="project_status[]" value="<?php echo set_value('project_status[]'); ?>" class="form-control project_status" size="6" readonly>
                </td>
                <td>
                    <input type="text" name="remark[]" value="<?php echo set_value('remark[]'); ?>" class="form-control" class="form-control">
                </td>
   			</tr>
        </tbody>
        </table>
<div class="alert alert-danger" role="alert">溫馨提醒：送出前請務必再次確認內容，因事後無法修改與刪除，謝謝。</div>
<div class="form-group">      
<input type="submit" name="submit" value="確定資料正確，送出" class="btn btn-primary" />
</div>
<!-- Hidden fields -->
<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
<input type="hidden" name="publish_status" value="1">
</form><!--End:新增記錄表單-->
    </div>

</body>
</html>