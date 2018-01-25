<!DOCTYPE html>
<html>

<!-- Mirrored from thememakker.com/swift-admin/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 Jan 2017 14:39:09 GMT -->
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>:: Report System ::</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Custom Css -->
<link href="include/css/main.css" rel="stylesheet">
<link href="include/css/login.css" rel="stylesheet">

<!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="include/css/themes/all-themes.css" rel="stylesheet" />
</head>
<body class="login-page authentication">

<div class="container">
    <div class="card-top"></div>
    
    <?php if(isset($_COOKIE['msg'])){?>
       <h4 class="alert alert-danger"><?php echo $_COOKIE['msg'];setcookie("msg","",time()-5,"/");?></h4> 
    <?php }?>
    
    <div class="card">
        <h1 class="title"><span>Report Admin</span>Login <div class="msg">Sign in to start your session</div></h1>
        <div class="col-md-12">
            <form action="access.php" method="POST">
                
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="uname" placeholder="Username" required autofocus>
                    </div>
                </div>
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="pword" placeholder="Password" required>
                    </div>
                </div>
                <div>
                    
                    <div class="text-center">
                        <button  class="btn btn-raised waves-effect g-bg-cyan" type="submit" name="login">SIGN IN</button>
                    </div>
                    <!--<div class="text-center"> <a href="forgot-password.html">Forgot Password?</a></div>-->
                </div>
            </form>
        </div>
    </div>    
</div>
<div class="theme-bg"></div>

<!-- Jquery Core Js --> 
<script src="include/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="include/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 


<script src="include/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="include/js/pages/examples/sign-in.js"></script>

</body>

<!-- Mirrored from thememakker.com/swift-admin/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 Jan 2017 14:39:11 GMT -->
</html>