<?php include("global_head.php"); //表頭 ?>
<body>
	<?php include("global_header.php"); //導覽列 ?>
	<div class="container">
    <h2 class="text-center">修改使用者</h2>
    <!--修改記錄表單-->
		<?php
    $attributes = array('class' => 'form', 'id' => 'form1');
    echo form_open('authorize/action_update_user', $attributes);  ?>
      <?php 
        foreach($results as $row){ 
        $id= $row->id;
        $username= $row->username;
        $password= $row->password;
        $level= $row->level;
        $status= $row->status;
       }?>
      <?php 
        $query = $this->db->get_where('user_profile', array('username'=>$username));
        foreach ($query->result() as $row2){ 
        $name_tw= $row2->name_tw;
        $name_en= $row2->name_en;
        $division= $row2->division;
        $department= $row2->department;
        $unit= $row2->unit;
        $supervisor_1= $row2->supervisor_1;
        $supervisor_2= $row2->supervisor_2;
        $supervisor_3= $row2->supervisor_3;
        }?>
              <div class="form-group">
                <label>帳號(工號)</label>
                <input id="username" type="text" name="username" value="<?php echo $username; ?>" class="form-control" readonly>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">重置密碼</button>
              </div>
              <div class="form-group">
                <label>權限</label>
                <input id="level" type="text" name="level" value="<?php echo $level; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label>狀態</label>
                <select name="status" value="<?php echo $status; ?>" class="form-control">
                  <option value="0" <?php if($status == 0){ echo 'selected="selected"'; } ?>>啟用</option>
                  <option value="1" <?php if($status == 1){ echo 'selected="selected"'; } ?>>停用</option>
                </select>
              </div>
              <div class="form-group">
              <label>中文名</label>
              <input id="name_tw" type="text" name="name_tw" value="<?php echo $name_tw; ?>" class="form-control" size="6">
              </div>
              <label>英文名</label>
              <input id="name_en" type="text" name="name_en" value="<?php echo $name_en; ?>" class="form-control">
              <div class="form-group">
              <label>處別</label>
              <input id="division" type="text" name="division" value="<?php echo $division; ?>" class="form-control">
              </div>
              <div class="form-group">
              <label>部別</label>
              <input id="department" type="text" name="department" value="<?php echo $department; ?>" class="form-control" size="6">
              </div>
              <div class="form-group">
              <label>課別</label>
              <input id="unit" type="text" name="unit" value="<?php echo $unit; ?>" class="form-control">
              </div>
              <div class="form-group">
              <label>處級主管</label>
              <input id="supervisor_1" type="text" name="supervisor_1" value="<?php echo $supervisor_1; ?>" class="form-control">
              </div>
              <div class="form-group">
              <label>部級主管</label>
              <input id="supervisor_2" type="text" name="supervisor_2" value="<?php echo $supervisor_2; ?>" class="form-control">
              </div>
              <div class="form-group">
              <label>課級主管</label>
              <input id="supervisor_3" type="text" name="supervisor_3" value="<?php echo $supervisor_3; ?>" class="form-control">
              </div>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
        
    <div class="form-group">      
    <input type="submit" name="submit" value="確定" class="btn btn-primary" />
    <input type="button" onclick="history.back();" value="取消" class="btn btn-default">
    </div>
  <?php echo form_close(); ?><!--End:修改記錄表單-->
  <!--重置密碼表單-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">重置密碼</h4>
      </div>
      <div class="modal-body">
        <?php
        $attributes = array('class' => 'form', 'id' => '');
        echo form_open('authorize/action_update_user_pw', $attributes);  ?>
        <div class="form-group">
          <label>新密碼</label>
          <input id="" type="text" name="password" value="" class="form-control">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary">確定</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <?php echo form_close(); ?><!--End:重置密碼表單-->
      </div>
    </div>
  </div>
</div>
    
</div><!--End:Container-->

</body>
</html>