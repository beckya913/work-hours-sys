<?php 
              $query = $this->db->get_where('authorize', array('username'=>$_SESSION['username']));
              foreach ($query->result() as $row){ 
                $level= $row->level;
              }?>
              
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">	
	<ul class="navbar-nav mr-auto">
          <li class="nav-item">
          	<a class="navbar-brand" href="#">工時單系統</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>main/create">新增紀錄</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>main/<?php 
            if ($level==1) { echo 'review';
              # code...
            }else{ echo 'review_standarduser';}
             ?>">瀏覽紀錄</a>
          </li>
          <li class="nav-item" style="<?php if ($level==0){ echo "display: none;"; } ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>main/review_project_advance">管理專案列表</a>
          </li>
          <li class="nav-item">
    <a class="nav-link" disabled href="#">(登入身份：<?php echo $_SESSION['username']; ?> <?php $query = $this->db->get_where('user_profile', array('username'=>$_SESSION['username']));
							foreach ($query->result() as $row){ ?>
							<?php echo $row->name_tw; ?> <?php }?>)</a>
  </li>
  <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>authorize/logout">登出</a>
          </li>
        </ul>
</nav>

