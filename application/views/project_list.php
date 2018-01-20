<?php include("global_head.php"); //表頭 ?>
<body>
	<div class="container">
	<script type="text/javascript"> // Launch serch function
		$(document).ready(function(){
			$('#search').keyup(function(){
				searchTable($(this).val());
			});
		});

		function searchTable(inputVal){
			var table = $('#project_list');
			table.find('tr').each(function(index, row){
				var allCells = $(row).find('td');
				if(allCells.length > 0){
					var found = false;
					allCells.each(function(index, td){
						var regExp = new RegExp(inputVal, 'i');
						if(regExp.test($(td).text())){
							found = true;
							return false;
						}
					});
				if(found == true)$(row).show();else $(row).hide();
				}
			});
		}
	</script>
	<form>
		<div class="form-group">
			<label>關鍵字搜尋</label>
			<input class="form-control" type="text" id="search">
		</div>
	</form>
	<table class="table table-striped" id="project_list">
		<thead>
			<tr>
				<th></th>
				<th>專案代碼</th>
				<th>客戶名稱</th>
				<th>專案名稱</th>
				<th>專案狀態</th>
				<th>開案日期</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($results as $row){ ?>
			<tr>
				<td>
					<script type="text/javascript">

function reval(a,b,c){

  var project_code = <?php echo json_encode($this->uri->segment(3)); ?>;
  var project_name = <?php echo json_encode($this->uri->segment(4)); ?>;
  var project_status = <?php echo json_encode($this->uri->segment(5)); ?>;
  window.opener.document.getElementById(project_code).value=a;
  window.opener.document.getElementById(project_name).value=b;
  window.opener.document.getElementById(project_status).value=c;
  window.close();
}

</script>
				
				<input type="button" value="選取" onclick="reval('<?php echo $row->code;?>','<?php echo $row->name;?>','<?php echo $row->status;?>')"></td>
				<td><?php echo $row->code; ?></td>
				<td><?php echo $row->customer; ?></td>
				<td><?php echo $row->name; ?></td>
				<td><?php echo $row->status; ?></td>
				<td><?php echo $row->start_date; ?></td>
			</tr>
			<? }?>
		</tbody>
	</table>
</body>
</div>
</html>