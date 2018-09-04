<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/customer.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Customer Relationship Management</title>
    <script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
  </head>
  <body class="height-1024">
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <!-- <h1>Vali</h1> -->
        <img src="images/logo.png">
      </div>
      <div class="row login-box col-xl-12">
      	<div class="col-xl-6 border-right-offset">
      		<div class="offset-2 col-xl-8">
            <form id="login_form">
		          <h3 class="login-head">
		          	<img src="images/tavicoCRM.png">
		          </h3>
		          <div class="form-group">
		            <label class="control-label login-label">Tên đăng nhập</label>
		            <input class="form-control login-input" name="username" type="text" required="" placeholder="Username" autofocus>
		          </div>
		          <div class="form-group">
		            <label class="control-label login-label">Mật khẩu</label>
		            <input class="form-control login-input" name="password" type="password" required="" placeholder="Password">
		          </div>
              <!-- <div class ="form-group lgin">
                <div class="g-recaptcha"  data-sitekey="6LfAwGEUAAAAAALMyZ8u3T74s3c6LAotyexVJ2zz"></div>
              </div> -->
              <div class="form-group">
                <p class="text-danger alert-danger"><?php if($this->session->flashdata('message')){echo($this->session->flashdata('message'));}?></p>
              </div>
		          <div class="form-group btn-container">
		            <!-- <button type="button" class="btn btn-primary btn-block" onclick="checkCaptcha()"><i class="fa fa-sign-in fa-lg fa-fw"></i>Log in</button> -->
                <!--<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Log in</button>-->
                <button class="btn btn-primary btn-block btn_login" type="submit"><i class="fa fa-sign-in"></i>Log in</button>
		          </div>
              <div class="form-group">
                <!-- <p class="text-danger alert-danger"><?php if($this->session->flashdata('message')){echo($this->session->flashdata('message'));}?></p> -->
                <!-- <div class="utility">
                  <div class="animated-checkbox">
                    <label>
                      <input name="remember_me" type="checkbox"><span class="label-text">Stay Signed in</span>
                    </label>
                  </div>
                  <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Quên mật khẩu ?</a></p>
                  <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Chưa có tài khoản ?</a></p>
                </div> -->
                <p class="semibold-text mb-2"><a href="#" data-toggle="flipppp">Quên mật khẩu ?</a></p>
                <p class="semibold-text mb-2"><a href="#" data-toggle="flipppp">Chưa có tài khoản ?</a></p>
              </div>

		        </form>

		        <form class="forget-form" action="">
		          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
		          <div class="form-group">
		            <label class="control-label">EMAIL</label>
		            <input class="form-control" type="text" placeholder="Email">
		          </div>
		          <div class="form-group btn-container">
		            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
		          </div>
		          <div class="form-group mt-3">
		            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
		          </div>
		        </form>
      		</div>
      	</div>
      	<div class="col-xl-6 text-center">
      		<h5 class="margin-top-50">THE FRIENDLY <a href="">CUSTOMER SERVICE</a> SYSTEM</h5>
      		<p class="no-margin-bot">Smart help desk support via e-mail, telephony, chatting and more…</p>
      		<p>CLICK TO DISCOVER AWESOME FEATURE</p>
      		<img class="clearfix" src="images/people.png">
      	</div>
      </div>
    </section>
    <form method="post" action="<?php echo base_url() ?>dashboard" id="myForm" >
        <input type="hidden" name="custid" id="custid">
        <input type="hidden" name="groupid" id="groupid">
        <input type="hidden" name="telephone" id="telephone">
        <input type="hidden" name="username" id="username1">
        <input type="hidden" name="password" id="password1">
        <input type="hidden" name="custname" id="custname">
        <input type="hidden" name="avatar" id="avatar">
        <input type="hidden" name="roleid" id="roleid">
        <input type="hidden" name="idcard" id="idcard">
    </form>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/plugins/sweetalert.min.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <?php echo isset($script) ? $script : ''; ?>
    
  </body>
</html>