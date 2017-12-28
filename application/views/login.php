<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>工時單:::登入</title>
	<!-- install UIKit powered by Yootheme -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <!-- Finish installation -->
    <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
    <!-- Finish installation -->
</head>
<body>
    <body>
        <div class="container" id="loginbox">
            <h2 class="text-center">工時單系統</h2>
                <?php
        $attributes = array('class' => '', 'id' => 'form_login');
        echo form_open('authorize/checklogin', $attributes);  ?>
                    <div class="form-group">
                        <?php $data = array('name'=> 'username','placeholder'=> '帳號','type'=> 'text','class'=> 'form-control'); 
                        echo form_input($data); ?>
                    </div>
                    <div class="form-group">
                        <?php $data = array('name'=> 'password','placeholder'=> '密碼','type'=> 'password','class'=> 'form-control'); 
                        echo form_input($data); ?>
                    </div>
                    <div class="text-center">
                        <?php $data = array('type'=> 'submit','class'=> 'btn btn-primary','value'=> '登入'); 
                        echo form_input($data); ?>
                    </div> 
                <?php echo form_close(); ?>

          </div>

</body>
</html>