<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>
	<h2 class="text-center">管理專案列表</h2>
	<form action="action_create_project" method="POST"><!-- 新增專案 -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th></th>
				<th>專案代碼</th>
				<th>專案名稱</th>
				<th>專案狀態</th>
				<th>開案日期</th>
				<th>結案日期</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
				<input type="submit" name="submit" value="新增" class="btn btn-primary"></td>
				<td><input type="text" name="code" value=""></td>
				<td><input type="text" name="name" value=""></td>
				<td><input type="text" name="status" value=""></td>
				<td><input type="text" name="start_date" value=""></td>
				<td><input type="text" name="end_date" value=""></td>
			</tr>
			
		</tbody>
	</table>
	</form><!-- End:新增專案 -->

	<!-- 專案列表 -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th></th>
				<th>專案代碼</th>
				<th>專案名稱</th>
				<th>專案狀態</th>
				<th>開案日期</th>
				<th>結案日期</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($results as $row){ ?>
			<tr>
				
				<td><a href="<?php echo site_url("main/update_project/".$row->id); ?>" class="btn btn-secondary">修改</a></td>
				<td><?php echo $row->code; ?></td>
				<td><?php echo $row->name; ?></td>
				<td><?php echo $row->status; ?></td>
				<td><?php echo $row->start_date; ?></td>
				<td><?php echo $row->end_date; ?></td>
			</tr>
			<input type="hidden" name="id" value="<?php echo $row->id; ?>">
			<? }?>
		</tbody>
	</table>
	
	</form><!-- End:修改專案 -->
</body>
</html>