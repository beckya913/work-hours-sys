<?php include("global_head.php"); //表頭 ?>
<body>
	<!-- 修改專案 -->
	<?php
		$attributes = array('class' => 'form', 'id' => '');
		echo form_open('main/action_update_project', $attributes);  ?>

		<table class="table table-striped">
		<thead>
			<tr>
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
				<td><input type="text" name="code" value="<?php echo $row->code; ?>"></td>
				<td><input type="text" name="name" value="<?php echo $row->name; ?>"></td>
				<td><input type="text" name="status" value="<?php echo $row->status; ?>"></td>
				<td><input type="text" name="start_date" value="<?php echo $row->start_date; ?>"></td>
				<td><input type="text" name="end_date" value="<?php echo $row->end_date; ?>"></td>
			</tr>
			<input type="hidden" name="id" value="<?php echo $row->id; ?>">
			<? }?>
			<tr>
				<td colspan="5">
					<input type="submit" name="submit" value="確定" class="btn btn-primary">
					<input type="button" onclick="history.back();" value="取消" class="btn btn-default">
				</td></tr>
		</tbody>
	</table>
	
	<?php echo form_close(); ?>
</body>
</html>