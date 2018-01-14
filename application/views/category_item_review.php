<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>

	<div class="container">
	<h2 class="text-center">管理類別/細項工作</h2>

<!-- 新增類別的對話筐 -->
<div class="modal fade" id="add_new_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">新增類別</h5>
      </div>
      <div class="modal-body" >
        <form data-toggle="validator" role="form" action="action_create_main_category" method="POST" class="form-horizontal" id="action_create_main_category">
		 <div class="form-group">
		   <label for="">類別名稱</label>
		   <input type="text" class="form-control" name="name" data-error="名稱未填" required>
		   <div class="help-block with-errors"></div>
		 </div>
		 <div class="form-group">
		   <label for="">所屬部門</label>
		   <select name="department" value="" class="form-control">
		<option>選擇部門</option>
		<option value="產品開發處">產品開發處</option>
		<option value="軟體研發處">軟體研發處</option>
		</select>
		 </div>
		 <button type="submit" class="btn btn-primary">新增</button>
		 <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
		</form>
      </div>
    </div>
  </div>
</div><!-- End:新增類別的對話筐 -->
	
	<form data-toggle="validator" role="form" action="action_create_category_item" method="POST"><!-- 新增細項工作 -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th></th>
				<th>部門</th>
				<th>類別</th>
				<th>細項工作</th>	
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
				<input type="submit" name="submit" value="新增" class="btn btn-primary"></td>
				<td>
					<select name="department" value="" id="department" class="form-control">
						<option>選擇部門</option>
						<option value="產品開發處">產品開發處</option>
						<option value="軟體研發處">軟體研發處</option>
					</select>
				</td>
				
				<td>
					<select name="cid" value="" id="categories" class="form-control" onchange="openPopup()">
					<option>選擇類別</option>
					</select>
					<script type="text/javascript">

					    $(document).on('change', '#department', function(){ // 自動帶出部門相關的類別

					   var department = $('#department :selected').val();
					   $.ajax({
					      url: "<?= base_url() ?>main/get_main_category",				
					      method:"POST",
					      data:{
					         department:department
					      },					
					      success: function(data) {
					        $('#categories option').remove();
					        $('#reminder').nextAll().remove()
					        $.each(data, function(i, data) {
					        $('#categories').append("<option value='" + data.cid + "'>" + data.name + "</option>");
					    });
					        $("<option value='addnew' data-toggle='modal' data-target='#myModal'>新增類別</option>").insertAfter('#categories option:last-child');
					        }
					   });//End:ajax
					});
					    
						$("#categories").on("change", function () {  //顯示新增類別的功能      
						    $modal = $('#add_new_category');
						    if($(this).val() === 'addnew'){
						        $modal.modal('show');
						    }
						});
				</script>
				</td>
				<td>
					<div class="form-group">
					<input type="text" name="item" value="" class="form-control" placeholder="請輸入名稱" data-error="細項工作未填" required>
					<div class="help-block with-errors"></div>
					</div>
				</td>
			</tr>
			
		</tbody>
	</table>
	</form><!-- End:新增細項工作 -->

	<!-- 專案列表 -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th></th>
				<th>細項工作</th>
				<th>類別</th>
				<th>部門</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($results as $row){ ?>
			<?php 
				$query = $this->db->get_where('categories', array('cid'=>$row->cid));
				foreach ($query->result() as $row2){ ?>
			<tr>
				
				<td><a href="<?php echo site_url("main/update_category_item/".$row->id); ?>" class="btn btn-default">修改</a></td>
				<td><?php echo $row->item; ?></td>
				<td><?php echo $row2->name; ?></td>
				
				<td><?php echo $row2->department; ?></td>
			</tr>
			<input type="hidden" name="id" value="<?php echo $row->id; ?>">
			<? }?>
			<? }?>
		</tbody>
	</table>
	
	</form><!-- End:修改專案 -->
	</div>
	<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
	
    
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
    
    
</body>
</html>