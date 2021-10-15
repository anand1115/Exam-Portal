<?php 
session_start();
ob_start();
include "db.php";
if (isset($_SESSION['username'])) {
	?>
	<?php if(!isset($_SESSION['score'])) {
		header("location: question.php?number=1");
	}
	?>
<html>
	<head>
		<title>Quiz</title>
		<style>
			body{
				padding:0;
				margin:0;
				background-color:black;
				font-weight:bold;
			}
			#total{
				background-color:white;
				text-align:center;
				width:500px;
				margin:0 auto;
				margin-top:25vh;
				border-radius:20px;
				padding:30px;
			}
			.start{
				text-decoration:none;
				background-color:red;
				font-size:20px;
				color:white;
				padding:5px;
			}
		</style>
	</head>

	<body>
		<div id="total">
		<header>
			<div class="container">
				<h1>Quiz::Result</h1>
			</div>
		</header>

		<main>
			<div class= "container">
			<h2>Congratulations!</h2> 
				<p>You have successfully completed the test</p>
				<p>Total points: <?php if (isset($_SESSION['score'])) {
echo $_SESSION['score']; 
}; ?> </p>
		<a href="quizstart.php" class="start">Start Again</a>	<br><br>
		<a href="index.php" class="start">Go Home</a>
		<!-- <form action="index.php" method="POST">
			<input type="textarea" name="review">
			<input type="submit" value="submit">
		</form>
 -->		</div>
		</main>
	    </div>
		</body>
		</html>

		<?php 
		date_default_timezone_set('Asia/Kolkata');
		$score = $_SESSION['score'];
		$email = $_SESSION['email'];
		$now = date("Y-m-d H:i:s");
		$username=$_SESSION['username'];
 $query = "INSERT into `results` (username,email,played_on,score)
VALUES ('$username','$email', '$now','$score')";
        $result = mysqli_query($con,$query);
 		?>


<?php unset($_SESSION['score']); ?>
<?php unset($_SESSION['time_up']); ?>
<?php unset($_SESSION['start_time']); ?>
<?php }
else {
	header("location: index.php");
}
ob_end_flush();
?>

