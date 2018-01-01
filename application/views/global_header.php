<?php 
              $query = $this->db->get_where('authorize', array('username'=>$_SESSION['username']));
              foreach ($query->result() as $row){ 
                $level= $row->level;
              }?>
              
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">工時單系統</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a class="nav-link" href="<?php echo base_url(); ?>main/create">新增紀錄</a></li>
        <li><a class="nav-link" href="<?php echo base_url(); ?>main/<?php 
            if ($level==1) { echo 'review';
              # code...
            }else{ echo 'review_standarduser';}
             ?>">瀏覽紀錄</a></li>
        <li class="dropdown" style="<?php if ($level==0){ echo "display: none;"; } ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">系統維護 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>main/review_project_advance">管理專案列表</a></li>
            <li><a href="<?php echo base_url(); ?>main/review_category_item">管理類別</a></li>
          </ul>
        </li>
      </ul>
  
      <ul class="nav navbar-nav navbar-right">
      <li class="nav-item">
    <a class="nav-link" disabled href="#">登入身份：<?php echo $_SESSION['username']; ?> <?php $query = $this->db->get_where('user_profile', array('username'=>$_SESSION['username']));
              foreach ($query->result() as $row){ ?>
              <?php echo $row->name_tw; ?> <?php }?> ||</a>
  </li>
  <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>authorize/logout">登出</a>
      </li>
    </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

