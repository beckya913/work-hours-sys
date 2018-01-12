<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>
	<!-- 新增/移除表格列數 -->
	<script type="text/javascript">
    	$(document).ready(function() {

        	$("#add").click(function() {
          		$('#items tbody>tr:last').clone(true).insertAfter('#items tbody>tr:last');
          		$('#items tbody>tr:last').find('input:text').val('');
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
    <h2 class="text-center">新增使用者</h2>
        <!--新增記錄表單-->
		<form data-toggle="validator" role="form" action="action_create_user" method="POST" enctype="multipart/form-data" id="hours_submit">
            <input id="add" value="新增一列" type="button" class="btn btn-default">
            <input id="remove" value="移除最後一列" type="button" class="btn btn-default">
		    <table id="items" class="table">
			<tbody>
   				<tr> 
         			<th>帳號(工號)</th>
              <th>密碼</th>
              <th>權限</th>
         			<th>中文名</th>
         			<th>英文名</th>
         			<th>處別</th>
         			<th>部別</th>
         			<th>課別</th>
         			<th>處級主管</th>
         			<th>部級主管</th>
         			<th>課級主管</th>
   				</tr>
   				<tr class="addrows">
                <td>
                    <input id="username" type="text" name="username[]" value="<?php echo set_value('username[]'); ?>" class="form-control">
                </td>
                <td>
                    <input id="password" type="text" name="password[]" value="<?php echo set_value('password[]'); ?>" class="form-control">
                </td>
                <td>
                    <input id="level" type="text" name="level[]" value="<?php echo set_value('level[]'); ?>" class="form-control">
                </td>
                <td>
                    <input id="name_tw" type="text" name="name_tw[]" value="<?php echo set_value('name_tw[]'); ?>" class="form-control" size="6">
                </td>
                <td>
                    <input id="name_en" type="text" name="name_en[]" value="<?php echo set_value('name_en[]'); ?>" class="form-control">
                </td>
                <td>
                    <input id="division" type="text" name="division[]" value="<?php echo set_value('division[]'); ?>" class="form-control">
                </td>
                <td>
                    <input id="department" type="text" name="department[]" value="<?php echo set_value('department[]'); ?>" class="form-control" size="6">
                </td>
                <td>
                    <input id="unit" type="text" name="unit[]" value="<?php echo set_value('unit[]'); ?>" class="form-control">
                </td>
                <td>
                    <input id="supervisor_1" type="text" name="supervisor_1[]" value="<?php echo set_value('supervisor_1[]'); ?>" class="form-control">
                </td>
                <td>
                    <input id="supervisor_2" type="text" name="supervisor_2[]" value="<?php echo set_value('supervisor_2[]'); ?>" class="form-control">
                </td>
                <td>
                    <input id="supervisor_3" type="text" name="supervisor_3[]" value="<?php echo set_value('supervisor_3[]'); ?>" class="form-control">
                </td>
   			</tr>
        </tbody>
        </table>
    <div class="form-group">      
    <input type="submit" name="submit" value="確定" class="btn btn-primary" />
    </div>
</form><!--End:新增記錄表單-->
    <h2 class="text-center">使用者列表</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>帳號(工號)</th>
          <th>中文名</th>
          <th>英文名</th>
          <th>處別</th>
          <th>部別</th>
          <th>課別</th>
        </tr>
        <tr></tr>
      </thead>
      <tbody>
        <?php foreach($results as $row){ ?>
        <?php 
          $query = $this->db->get_where('user_profile', array('username'=>$row->username));
          foreach ($query->result() as $row2){ ?>
        <tr>
          <td><a href="<?php echo site_url("authorize/update_user/".$row->id); ?>" class="btn btn-default">修改</a></td>
          <td><?php echo $row->username; ?></td>
          <td><?php echo $row2->name_tw; ?></td>
          <td><?php echo $row2->name_en; ?></td>
          <td><?php echo $row2->division; ?></td>
          <td><?php echo $row2->department; ?></td>
          <td><?php echo $row2->unit; ?></td>
        </tr>
        <input type="hidden" name="id" value="<?php echo $row->id; ?>">
        <? }?>
        <? }?>
      </tbody>
    </table>
    </div>

</body>
</html>