<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>
	
	<div class="container">
	<h2 class="text-center">管理類別/細項工作</h2>

	<div class="panel panel-info" id="add_new_category" style="display: none;">
  <div class="panel-heading">
    <h3 class="panel-title">新增類別</h3>
  </div>
  <div class="panel-body">
    <form action="action_create_main_category" method="POST" class="form-horizontal">
		 <div class="form-group">
		   <label for="">類別名稱</label>
		   <input type="text" class="form-control" name="name">
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
		</form>
  </div>
</div>
	
	<form action="action_create_category_item" method="POST"><!-- 新增專案 -->
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
					    $("#categories").change(function(){ // 轉至新增類別的功能頁
							if ($("option:last").is(":selected")) {
							$("#add_new_category").toggle(1000);
							      }    
							});
				</script>
				</td>
				<td><input type="text" name="item" value=""></td>
			</tr>
			
		</tbody>
	</table>
	</form><!-- End:新增專案 -->

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
				
				<td><a href="<?php echo site_url("main/update_category_item/".$row->id); ?>" class="btn btn-primary">修改</a></td>
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
</body>
</html>