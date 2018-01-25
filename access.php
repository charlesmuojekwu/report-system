<?php 
 session_start(); ob_start();

ini_set('display_errors', '1');

  $conn = mssql_connect("216.158.234.108\SQLEXPRESS","Report","Charles111");
          mssql_select_db("AdmissionPortal_Database");

if( $conn ) {
      "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
    
}



//////////////////// LOGIN CONTROL /////////////////////

if(isset($_REQUEST['login'])){
	
	$uname=  ($_POST['uname']);
	$pword=  ($_POST['pword']);
	
	
	 $tsql="SELECT username FROM ReportUsers WHERE username='$uname' AND password='$pword'";
    $results = mssql_query($tsql);
    
     $ct = mssql_num_rows($results); 
      
        if($ct == 0){
			
	setcookie("msg","Invalid Login Credentials.",time()+5,"/");
              header("location:index.php");	
	}else{
		
	
		
		 $_SESSION['uname']=$uname;
		
		header('location:home.php?login success');
	}

}



///////////////////  LOGOUT CONTROL  ///////////////////////////
if(isset($_REQUEST['logout'])){
	
	session_destroy();
	header('location:index.php');

}


///////////////////  SIGNUP CONTROL  ///////////////////////////
if(isset($_REQUEST['signup'])){
    
    $uname=  ($_POST['uname']);
	$pword=  ($_POST['pword']);	
	$cpword= ($_POST['cpword']);
	$email=  ($_POST['email']);	
	
	
	
    
	if(!empty($uname) && !empty($pword) && !empty($cpword) && !empty($email)   ){
		if($pword != $cpword){
		
			setcookie("msg","Password mismatch.",time()+5,"/");
              header("location:register.php");
		}else{
	
            
    $statement ="INSERT INTO ReportUsers (username,password,email) VALUES('$uname','$pword','$email')";

   $results = mssql_query($statement);
    
    if($results==true){
   
		setcookie("msg","Account Has Been created.",time()+5,"/");
              header("location:register.php");
	   }else{
		   setcookie("msg","Account not created.",time()+5,"/");
              header("location:register.php");
	   }
		}
    }else{
	
		setcookie("msg","fill out all fields",time()+5,"/");
              header("location:register.php");
	}
}

?>