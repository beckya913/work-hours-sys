<?php 
	
if(!isset($_SESSION)) {

session_start();

}  

if(!isset($_SESSION['username'])){

echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
		alert('請先登入，謝謝。');
	  </script></body></html>";

redirect('authorize/login/','refresh');

}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>GIT 工時單系統</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css">
	<script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <!-- Finish installation -->
    <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>js/FileSaver.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
    
    <script type="text/javascript">// Enable date picker
		 $(function() {
		    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		
		  });
	</script>
	<!-- Form Validation -->
    <script type="text/javascript">
    $(function(){
		$("#hours_submit").validate();
	});
    </script>
	
</head>