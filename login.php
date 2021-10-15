<?php session_start();
ob_start();

 ?>
<html>
<meta charset="utf-8">
<title>Login</title>
<style type="text/css">
			*{
				margin:0;
				padding:0;
				font-family:sans-serif;
			}
	
			a{
			     color:red;
			     text-decoration:none;
			}
			a:hover{
			     text-decoration:underline;
			}    
			.form{
				 padding:20px;
			     width:400px;
			     margin: 0 auto;
			     margin-top:20vh;
			     background-color:rgba(129, 133, 130,0.6);
			     text-align:center;
			}
			input[type='text'],
			input[type='password'] {
			     width: 200px;
			     border-radius: 2px;
			     padding: 10px;
			     color: #333;
			     font-size: 14px;
			     margin-top: 10px;
			     border-style:none;
			     border-bottom-style:solid;
			}
			input[type='submit']{
			     padding: 10px 25px 8px;
			     color: #fff;
			     background-color:   #e7d03a;
			     text-shadow: rgba(231,208,58,0.24) 0 1px 0;
			     font-size: 16px;
			     box-shadow: rgba(231,208,58,0.24) 0 2px 0 0 inset,#fff 0 1px 0 0;
			     border: 1px solid  #e7d03a; 
			     border-radius: 2px;
			     margin-top: 10px;
			     cursor:pointer;
			}
			input[type='submit']:hover {
			     background-color:transparent;
			}
			p{
				margin:10px;
			}
			#Google{
				padding:10px;
				background-color:blue;
				color:white;

			}
			#Facebook{
				padding:10px;
				background-color: #5bb4f0;
				color:white;
			}
			.fa-google{
				width:40px;
				color:red;
			}
		.fa-facebook-square{
			width:25px;
		}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include('header.php');
require('db.php');

// If form submitted, insert values into the database.
unset($f);
if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$admin='4acb4bc224acbbe3c2bfdcaa39a4324e';
	if($username=='admin')
	{
	if(md5($password)==$admin)
	{
		$_SESSION['username'] = 'admin';
		header("Location: index.php");
	}
    }
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result =mysqli_query($con,$query);
	$temp=mysqli_fetch_array($result);
	$rows=mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
	    $_SESSION['email'] = $temp['email'];
	    header("Location: index.php");
         }
         else{
	          $f='n';
           }
       }
?>
<div class="form">
<h1>Log In</h1><br> <hr> <br>
<!-- <span id="Google"><i class="fa fa-google fa-lg" aria-hidden="true"></i>Login With Google</span><br><br><br>
<span id="Facebook"><i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i> Login With Facebook</span><br><br> -->
<?php if(isset($f)){echo "<h3>Username/password is incorrect.</h3>";}
 ?>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<br>
<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <br> <br><a href='signup.php'>Register Here</a></p>
</div>
</body>
</html>
<?php ob_end_flush(); ?>
