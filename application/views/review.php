<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>
	<div class="container-fluid">
	<script type="text/javascript"> // Launch serch function

		$(document).ready(function(){

			$('#search').keyup(function(){
				searchTable($(this).val());
			});
		});

		function searchTable(inputVal){

			var table = $('#items');

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
	<script type="text/javascript">//Export to Excel
		$(function () {

    $('#export_to_excel').click(function () {

        var blob = new Blob([document.getElementById('final-data').innerHTML], {

            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8"

        });

        var strFile = "Report.xls";

        saveAs(blob, strFile);

        return false;

    });

});

	</script>
	<div class="container-fluid">
	<h2 class="text-center">瀏覽紀錄</h2>
	
	<form id="date_serch" action="review_filter" method="POST" class="">
								    <label>日期區間</label><input type="text" class="datepicker" name="startdate" value=""/> 至
								    <input type="text" class="datepicker" name="enddate" value=""/>
								    <input type="submit" name="submit" value="確定" class="btn btn-default" />
								</form>
	<form class=""><label>關鍵字</label><input class="" type="text" id="search"></form>
	<hr>
	<a href="<?php echo base_url("main/review"); ?>" class="btn btn-primary" role="button">清除搜尋條件</a>
	<button id="export_to_excel" class="btn btn-primary">匯出Excel</button>
	<hr>
<table>
	<tbody>
		<tr>
			<td>
				<div id="final-data">
				<table id="items" class="table table-striped">
					<thead>
					    <tr> 
					          <th>工時單</th>
					          <th>工號</th>
					          <th>姓名</th>
					          <th>類別</th>
					          <th>細項工作</th>
					          <th>日期</th>
					          <th>星期</th>
					          <th>時數</th>
					          <th>專案代碼</th>
					          <th>備註</th>
					          <th>專案名稱</th>
					          <th>專案狀態</th>
					          <th>部門-處</th>
					          <th>部門-部</th>
					          <th>部門-課</th>
					    </tr>
					    </thead>
					    <tbody>
					    	<?php foreach($results as $row){ ?>
					    	<?php 
							//取得工時清單
							$query = $this->db->get_where('report_list',array('report_num'=>$row->report_num));
							foreach ($query->result() as $row2)
							{ ?>

							<?php 
								$query = $this->db->get_where('user_profile', array('username'=>$row->username));
								foreach ($query->result() as $row3){ ?>
							<?php 
								$query = $this->db->get_where('project', array('code'=>$row2->project_code));
								foreach ($query->result() as $row4){ ?>
							<?php 
								$query = $this->db->get_where('categories', array('cid'=>$row2->work_category));
								foreach ($query->result() as $row5){ ?>

							<?php 
								$query = $this->db->get_where('subcategories', array('id'=>$row2->sub_work_category));
								foreach ($query->result() as $row6){ ?>
		
					    	
					    <tr>
					    	<td><?php echo $row->report_num; ?></td>
					          <td><?php echo $row->username; ?></td>
					          <td><?php echo $row3->name_tw; ?></td>
					          
					          <td>
					          	<?php echo $row5->name; ?>
					          </td>
					          <td>
					          	<?php echo $row6->item; ?>
					          </td>
					          <td>
					          	<?php echo $row2->work_date; ?>
					          </td>
					      	  <td>
					      	  	<?php $date = $row2->work_date;
									echo date('D', strtotime($date)); ?>
					      	  </td>
					          <td>
					          	<?php echo $row2->work_hours; ?>
					          </td>
					          <td><?php echo $row2->project_code; ?></td>
					          <td><?php echo $row2->remark; ?></td>
					          <td><?php echo $row4->name; ?></td>
					          <td><?php echo $row2->project_status; ?></td>
					          <td><?php echo $row3->division; ?></td>
					          <td><?php echo $row3->department; ?></td>
					          <td><?php echo $row3->unit; ?></td>
					    </tr>
					    <?php } ?>
					    <?php } ?>
					    <?php } ?>
					    <?php } ?>
					    <?php } ?>
					    <?php } ?>
					</tbody>
				</table>
				</div>
			</td>
		</tr>
	</tbody>
</table>
</div>
</div>
</body>
</html>