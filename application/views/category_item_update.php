<?php include("global_head.php"); //表頭 ?>
<body>
	<div class="container">
	<h2 class="text-center">修改細項工作</h2>
	<!-- 修改專案 -->
	<?php
		$attributes = array('class' => 'form', 'id' => '');
		echo form_open('main/action_update_category_item', $attributes);  ?>

		<table class="table table-striped">
		<thead>
			<tr>
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
				<td><input type="text" name="item" class="form-control" value="<?php echo $row->item;; ?>"></td>
				<td><input type="text" name="name" class="form-control" value="<?php echo $row2->name; ?>" readonly></td>
				<td><input type="text" name="status" class="form-control" value="<?php echo $row2->department; ?>" readonly></td>
			</tr>
			<input type="hidden" name="id" value="<?php echo $row->id; ?>">
			<? }?>
			<? }?>
			<tr><td colspan="5"><input type="submit" name="submit" value="確定" class="btn btn-primary"></td></tr>
		</tbody>
	</table>
	
	<?php echo form_close(); ?>
</div>
</body>
</html>