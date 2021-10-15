<?php 
session_start();
ob_start();
include "db.php";
if (isset($_SESSION['username'])) 
{
	if(!isset($_SESSION['score'])) 
    {
		$_SESSION['score'] = 0;
	}
    
	if ($_POST) 
    {
        $newtime = time();
        if( $newtime > $_SESSION['time_up']) 
            {
            echo "<script>alert('time up');
            window.location.href='results.php';</script>";
            }
        else
        {
            $_SESSION['start_time'] = $newtime;
    		$questionno = $_POST['number'];
            $_SESSION['quiz'] = $_SESSION['quiz'] + 1;
    		$selected_choice = $_POST['choice'];
    		$nextquestion = $question+1;
    		$query = "SELECT correct_answer FROM questions WHERE questionno= '$questionno' ";
            $run = mysqli_query($con , $query) or die(mysqli_error($con));
            if(mysqli_num_rows($run) > 0 ) {
            	$row = mysqli_fetch_array($run);
            	$correct_answer = $row['correct_answer'];
            }
            if ($correct_answer == $selected_choice) {
            	$_SESSION['score']++;
            }
            $query1 = "SELECT * FROM questions ";
            $run = mysqli_query($con , $query1) or die(mysqli_error($con));
            $totalqn = mysqli_num_rows($run);
            if ($questionno == $totalqn) {
            	header("location: results.php");
            }
            else {
            	header("location: exam.php?n=".$nextquestion);
            }   
        }
    }
    else {
        header("location: index.php");
    }
}
else
{
	header("location: index.php");
}
ob_end_flush();
?>