<?php session_start();
       ob_start();
       if(!isset($_SESSION["username"])){
          header("Location: login.php");
             exit(); }
    include "db.php";
	if (isset($_SESSION['username'])) {
	$query = "SELECT * FROM questions";
	$run = mysqli_query($con , $query) or die(mysqli_error($con));
	$total = mysqli_num_rows($run);
}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quiz</title>
	<style>
		*{
			margin:0;
			padding:0;
		}
		#main{
			padding:50px;
			width:500px;
			background-color:black;
			color:white;	
			opacity:0.6;
			margin:0 auto;
			margin-top:20vh;
			font-size:25px;
			text-align:center;
			letter-spacing:1px;
		}
		div h2{
			animation-name:head;
			animation-duration: 5s;
			animation-delay:1s;
			animation-iteration-count:infinite; 
		}
		@keyframes head{
			0%{color:red;}
			25%{color:blue;}
			50%{color:white;}
			75%{color:blue;}
			100%{color:green;}
		}
		div ul{
			list-style-type:none;
		}
		div ul li{
			margin:5px;
			text-align:left;
		}
		div ul li span{
			color:#e3fc03;
			font-size:30px;
			font-weight:bolder;
		}
		#start{
			padding:10px 30px;
			width:200px;
			border-radius:20px;
			font-size:15px;
			font-weight:bolder;
			text-decoration:none;
			background-color:white;
			color:#0d05f2; 
		}
		#start:hover{
			background-color:#0d05f2;
			color:white;
		}
		#exit{
			padding:8px 40px;
			text-decoration:none;
			color:white;
			background-color:red;
		}

	</style>
</head>
<body>
	<?php include('header.php') ?>
	<div id="main">
		<h2>Welcome To Quiz</h2><br><br>
		<ul>
			<li><span>Number Of Questions</span>:<?php echo $total; ?></li>
			<li><span>Time</span>               :30 Sec for each question</li>
			<!-- <li><span>Number of Attempts</span> :3</li> -->
			<li><span>Type of Exam</span>        :Multiple Choices</li>
			<li><span>Score</span>              :+1 points for every correct answer</li>
		</ul><br><br>
		<a href="exam.php?number=1" id="start">Start quiz</a><br><br>
		<a href="index.php" id="Exit">Exit</a>	
	</div>	
</body>
<?php unset($_SESSION['score']); ?>
<?php ob_end_flush(); ?>
</html>