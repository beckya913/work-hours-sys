<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>
	<script type="text/javascript">// Enable date picker
		$(function() {
   		$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',
   		changeMonth: true,
   		changeYear: true });
 			});
	</script>
	<div class="container">
	<h2 class="text-center">管理專案列表</h2>
	<!-- 新增專案 -->
	<form data-toggle="validator" role="form" action="action_create_project" method="POST">
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
				<div class="form-group">
					<input type="submit" name="submit" value="新增" class="btn btn-primary">
				</div>
				</td>
				<td>
					<div class="form-group">
						<input type="text" name="code" value="" class="form-control" placeholder="請輸入代碼" data-error="代碼未填" required>
						<div class="help-block with-errors"></div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<input type="text" name="name" value="" class="form-control" placeholder="請輸入名稱" data-error="名稱未填" required>
						<div class="help-block with-errors"></div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<select name="status" value="" class="form-control">
							<option value="OPEN">OPEN</option>
							<option value="CLOSE">CLOSE</option>
						</select>
					</div>
				</td>
				<td>
					<div class="form-group">
						<input type="text" name="start_date" value="" class="datepicker form-control" data-error="開案日期未填" required>
						<div class="help-block with-errors"></div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<input type="text" name="end_date" value="" class="datepicker form-control">
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	</form> <!--End:新增專案 -->
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
				
				<td><a href="<?php echo site_url("main/update_project/".$row->id); ?>" class="btn btn-default">修改</a></td>
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

	</div>
</body>
</html>