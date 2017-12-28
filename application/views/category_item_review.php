<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>
	<h2 class="text-center">管理類別/細項工作</h2>
	<form action="action_create_category_item" method="POST"><!-- 新增專案 -->
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
			<tr>
				<td>
				<input type="submit" name="submit" value="新增" class="btn btn-primary"></td>
				
				<td><input type="text" name="name" value=""></td>
				<td>
					<select name="cid" value="" id="" class="form-control">
					<option>選擇類別</option>
						<?php 
						//取得類別
						$query = $this->db->get('categories');
						foreach ($query->result() as $row)
						{ 
						$cid=$row->cid;
						$name=$row->name; ?>
						<option value="<?php echo $cid; ?>"><?php echo $name; ?></option>  
						<?php } ?>
				</select></td>
				<td>
					<select name="department" value="" id="" class="form-control">
						<option>選擇部門</option>
						<option value="產品開發處">產品開發處</option>
						<option value="軟體研發處">軟體研發處</option>
					</select>
				</td>
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
				
				<td><a href="<?php echo site_url("main/update_project/".$row->id); ?>" class="btn btn-primary">修改</a></td>
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
</body>
</html>