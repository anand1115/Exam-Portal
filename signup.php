<?php ob_start(); ?>



<!DOCTYPE html>
<html>
<meta charset="utf-8">



<style>
    *{
        margin:0;
        padding:0;
        font-family:sans-serif;
    }
    .form a{
         color:#0067ab;
         text-decoration:none;
    }
    a:hover{
         text-decoration:underline;
    }    
    .form{
         padding:30px;
         width: 400px;
         margin: 0 auto;
         margin-top:20vh;
         background-color:rgba(129, 133, 130,0.6);
         text-align:center;
    }
    input[type='text'], input[type='email'],
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
         background-color: transparent;
    }
</style>



</head>
<body>
<?php
require('db.php');

include('header.php');

// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post"><br>
<input type="text" name="username" placeholder="Username" required /><br>
<input type="email" name="email" placeholder="Email" required /><br>
<input type="password" name="password" placeholder="Password" required /><br>
<input type="submit" name="submit" value="Register" />
</form>
<p>already have an account? <br><a href='login.php'>Login</a></p>
</div>
<?php } ?>
</body>
</html>
<?php ob_end_flush(); ?>