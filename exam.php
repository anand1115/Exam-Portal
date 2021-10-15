<script>
function showTimer() {
var time="00:0:30";
timer_div=document.getElementById('timer');
timer_div.innerHtML=time;
my_timer=setInterval(function() {
var hr=0;
var min=0;
var sec=0;
var time_up=false;
t=time.split(":");
hr=parseInt(t[0]);
min=parseInt(t[1]);
sec=parseInt(t[2]);
if(sec==0) {
if(min>0) {
sec=59;
min--;
}
else if(hr>0) {
min=59;
sec=59;
hr--;
}
else {
time_up=true;
}
}
else {
sec--;
}
if(hr<10)
hr="0"+hr;
if(min<10)
min="0"+min;
if(sec<10)
sec="0"+sec;
time=hr+" : "+min+" : "+sec;
if(time_up)
time="TIME UP";
timer_div=document.getElementById('timer');
timer_div.innerHTML=time;
if(time_up)
clearInterval(my_timer);
},1000);
}
</script>
<?php 
session_start();
ob_start();
include "db.php";
if (isset($_SESSION['username'])){
	if (isset($_GET['number']) && is_numeric($_GET['number'])) {
	        $questionno = $_GET['number'];
	        if ($questionno == 1) {
	        	$_SESSION['quiz'] = 1;
	        	$_SESSION['score'] = 0;
	        }
	        }
	        else {
	        	header('location: exam.php?number='.$_SESSION['quiz']);
	        }	

	        if (isset($_SESSION['quiz']) && $_SESSION['quiz'] == $questionno) {	
			$query = "SELECT * FROM questions WHERE questionno = $questionno";
			$run = mysqli_query($con , $query) or die(mysqli_error($con));	
			if (mysqli_num_rows($run) > 0) {
				$row = mysqli_fetch_array($run);
				$questionno = $row['questionno'];
                 $question = $row['question'];
                 $answer1 = $row['answer1'];
                 $answer2 = $row['answer2'];
                 $answer3 = $row['answer3'];
                 $answer4 = $row['answer4'];
                 $correct_answer = $row['correct_answer'];
                 $_SESSION['quiz'] = $questionno;
                 $checkquestion = "SELECT * FROM questions" ;
                 $runcheck = mysqli_query($con , $checkquestion) or die(mysqli_error($con));
                 $countquestion = mysqli_num_rows($runcheck);
                 $time = time();
                 $_SESSION['start_time'] = $time;
                 $allowed_time = 10 * 0.05;
                 $_SESSION['time_up'] = $_SESSION['start_time'] + ($allowed_time * 60) ;  
			}
			else {
				echo "<script> alert('something went wrong');
			window.location.href = 'quizstart.php'; </script> " ;
			}
		}
		else {
		echo "<script> alert('error');
			window.location.href = 'quizstart.php'; </script> " ;
	}
?>
<?php 
$total = "SELECT * FROM questions ";
$run = mysqli_query($con , $total) or die(mysqli_error($con));
$totalqn = mysqli_num_rows($run);

?>
<html>
	<head>
		<title>Online Quiz</title>
		<link rel="stylesheet" type="text/css" href="css/exam.css">
	</head>

	<body onload="showTimer();">
		<header>
			<div>
				<h1>Quiz on Php</h1>
			</div>
		</header>

		<main>
			<div class= "container">
				<h2 id="timer"></h2>
				<div class= "current">Question <?php echo $questionno; ?></div>
				<p class="question"><?php echo $question; ?></p>
				<form method="POST" action="exam_validation.php">
					<ul class="choices">
					   <li><input name="choice" type="radio" value="1" required=""><?php echo $answer1; ?></li>
					   <li><input name="choice" type="radio" value="2" required=""><?php echo $answer2; ?></li>
					   <li><input name="choice" type="radio" value="3" required=""><?php echo $answer3; ?></li>
					   <li><input name="choice" type="radio" value="4" required=""><?php echo $answer4; ?></li>
					 
					</ul>
					<input type="submit" id="submit" value="<?php if($questionno==$totalqn){echo 'Submit';}else{echo 'Next';} ?>" > 
					<input type="hidden" name="number" value="<?php echo $questionno;?>">
					<br>
					<br>
					<a href="results.php" class="start">End Exam</a>
				</form>
			</div>
		</main>
</body>
</html>

<?php } 
else {
	header("location: index.php");
}
	ob_end_flush();

?>