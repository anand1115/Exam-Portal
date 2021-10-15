<html>
<head>
	<style type="text/css">
		#header{
			display:flex;
			flex-flow:row wrap;
			justify-content:space-between;
			background-color:black;
			opacity:0.6;
		}
		#right,#left{
			display:inline-flex;
		}
		#right a{
			text-decoration:none;
			padding:30px;
			font-size:20px;
			color:white;
		}
		#left a{
			text-decoration:none;
			padding:30px;
			font-size:20px;
			color:white;
		}
		a:hover{
			border-style:solid;
			border-color:white;
			border-width:0.1px;
		}
		
	</style>
</head>
<body>
<header id="header">
	<div id="right">
	   <a href="index.php">Home</a>
	   <a href="#about">About</a>
	   <a href="#contactus">Contact</a>
	   <a href="#services">Services</a>
    </div>
    <div id="left">
    	<a href='<?php if(isset($_SESSION['username'])){echo "logout.php";}else{echo "login.php";} ?>'><?php if(isset($_SESSION['username'])){echo "logout";}else{echo "login";} ?></a>
    	<?php if(!isset($_SESSION['username'])){echo '<a href="signup.php">Signup</a>';} ?>  
    	<?php if(isset($_SESSION['username']))
    	{if($_SESSION['username']=='admin')
    	{echo '<a href="admin.php">Admin</a>';}
         } ?>
    </div>
</header>
</body>
</html>