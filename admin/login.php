<?php
    session_start();
    require_once "config/db_conn.php";
    require_once "public/global_functions.php";
    if(isset($_SESSION['user_id'])&&isset($_SESSION['full_name'])&&isset($_SESSION['position'])){
    	header("Location:index.php");
    }	
	
	if(isset($_POST['submit'])){
		$username=clean_input($db,$_POST['username']);
		$password=clean_input($db,$_POST['password']);

		if($username==''){
			echo '<script type="text/javascript">alert("Please enter your username to proceed!");</script>';
		}elseif($password==''){
			echo '<script type="text/javascript">alert("Please enter your password to proceed!");</script>';
		}else{
			$query="SELECT*FROM tbl_system_users WHERE 	username='$username' LIMIT 0,1";
			$res=$db->query($query);
			if($res->num_rows>0){
				$row=$res->fetch_array();
				extract($row);
				if(password_verify($password,$password_hash)){
					$_SESSION['user_id']=$user_id;
					$_SESSION['full_name']=$full_name;
					$_SESSION['position']=$position;
					header("Location:index.php");
				}else{
					echo '<script type="text/javascript">alert("Invalid Login credentials!");</script>';
				}
			}else{
				echo '<script type="text/javascript">alert("Invalid Login credentials!");</script>';
			}	
		}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RMS | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="lte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="lte/plugins/iCheck/square/blue.css">
  </head>  
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>RMS</b>Login</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="post" action="">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username" required="required">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required="required">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <!--<div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div>--><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <!--<div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div>--><!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="lte/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>