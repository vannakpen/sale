<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome!</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('vendors/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css'); ?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('vendors/jqvmap/dist/jqvmap.min.css'); ?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('build/css/custom.min.css'); ?>" rel="stylesheet"> 
    <!-- Load style -->
    <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?php echo base_url('vendors/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
  </head>
  <body>
  	<!-- Modal -->
<div class="modal fade" id="memberModal" tabindex="" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="memberModalLabel"><?php echo $this->lang->line('lab_login_title');?></h4>
        <div class="popup-language">
        	<?php
        	if($this->session->userdata('site_lang') == 'english'){
        	?>
        		<a href="<?php echo base_url('language/switch-lang/khmer');?>">ខ្មែរ</a>
        	<?php
        	}else{
        	?>
        		<a href="<?php echo base_url('language/switch-lang/english');?>">English</a>
        	<?php
        	}
        	?>
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group">
		  <input type="text" name="email" class="form-control" id="email" placeholder="<?php echo $this->lang->line('lab_email');?>" required="">
		</div>
		<div class="form-group">
		  <input name="password" type="password" class="form-control" id="password" placeholder="<?php echo $this->lang->line('lab_password');?>" required="">
		</div>
		<div class="form-group">
			<button type="button" class="btn btn-primary form-control" id="login" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing Order"><?php echo $this->lang->line('lab_button_login');?></button>
		</div>
      </div>
      <div class="modal-footer">
      	<a href="<?php echo base_url('account/reset-password'); ?>"><?php echo $this->lang->line('lab_lost_password');?></a> 
      	<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line('lab_button_register');?></button> 
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line('lab_button_close');?></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#memberModal').modal({
  backdrop: 'static',
  keyboard: true
})
$('#memberModal').modal('show');
$('#login').click(function(){
	var $this = $(this);
	var $email = $('#email').val();
	var $password = $('#password').val();
	$this.button('loading');
	$.ajax({
		method: "POST",
	  	url: "<?php echo base_url('account/login');?>",
	  	data: { email : $email, password : $password}
	}).done(function(data) {
		$this.button('reset');
	  	if(data == 'TRUE'){
                    var url = "<?php echo base_url('dashboard');?>";
                    <?php 
                    if($this->session->flashdata('redirect_back_url')){
                    ?>
                    url = "<?php echo $this->session->flashdata('redirect_back_url'); ?>";
                    <?php
                    }
                    ?>
                    window.location.href = url;
                    $this.button('reset');
	  	}else{
	  		alert('<?php echo $this->lang->line('msg_login_fail') ; ?>');
                        $this.button('reset');
	  	}
	});
});
//-->
</script>
  </body>