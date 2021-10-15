<?php session_start();
ob_start(); ?>
<?php include "db.php";
if (isset($_SESSION['username'])) {
	?>



<?php 
if (isset($_GET['questionno'])) {
	$questionno = mysqli_real_escape_string($con , $_GET['questionno']);
	if (is_numeric($questionno)) {
		$query = "SELECT * FROM questions WHERE questionno = '$questionno' ";
		$run = mysqli_query($con, $query) or die(mysqli_error($con));
		if (mysqli_num_rows($run) > 0) {
			while ($row = mysqli_fetch_array($run)) {
				 $questionno = $row['questionno'];
                 $question = $row['question'];
                 $answer1 = $row['answer1'];
                 $answer2 = $row['answer2'];
                 $answer3 = $row['answer3'];
                 $answer4 = $row['answer4'];
                 $correct_answer = $row['correct_answer'];
			}
		}
		else {
			echo "<script> alert('error');
			window.location.href = 'admin.php'; </script>" ;
		}
	}
	else {
		header("location: all.php");
	}
}

?>
<?php 
if(isset($_POST['submit'])) {
	$question =htmlentities(mysqli_real_escape_string($con , $_POST['question']));
	$choice1 = htmlentities(mysqli_real_escape_string($con , $_POST['choice1']));
	$choice2 = htmlentities(mysqli_real_escape_string($con , $_POST['choice2']));
	$choice3 = htmlentities(mysqli_real_escape_string($con , $_POST['choice3']));
	$choice4 = htmlentities(mysqli_real_escape_string($con , $_POST['choice4']));
	$correct_answer = mysqli_real_escape_string($con , $_POST['answer']);
    

	$query = "DELETE FROM questions WHERE questionno = '$questionno' ";
	$run = mysqli_query($con , $query) or die(mysqli_error($con));
	if (mysqli_affected_rows($con) > 0 ) {
		echo "<script>alert('Question successfully updated');
		window.location.href= 'admin.php'; </script> " ;
	}
	else {
		"<script>alert('error, try again!'); </script> " ;
	}
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Quiz</title>
		<style>
			body {
     font-family: arial;
     font-size: 15px;
     line-height: 1.6em;
     background-color:#0320fc;
}

li{
     list-style: none;
}

a{
     text-decoration: none;
}

label{
     display: inline-block;
     width: 180px;
     color:black;
}

input[type='text']{
     width: 90%;
     padding: 10px;
     border-radius: 5px;
     border:1px #ccc solid;
}

input[type='number']{
     width: 50px;
     padding: 4px;
     border-radius: 5px;
     border:1px #ccc solid;
}

.container{
     width: 60%;
     margin: 0 auto;
     overflow: auto;
}

header{
     border-bottom: 3px #272726 solid;
     background:#0320fc;
     color: white;
}

a.add {
     display: inline-block;
     color: #666;
     background: #f4f4f4;
     border-left: 7px #272726 solid;
     padding:6px 13px;
     position: right;
}

footer{
     border-top: 3px #272726 solid;
     background: #3A3A36;
     color: #BBBBB9;
     text-align: center;
     padding-top: 5px;
     padding-bottom: 5px;
}

main{
     padding-bottom: 20px;
     background:#9dfc03;
     color: white;
}


a.start{
     display: inline-block;
     color: #000000;
     background: #99CC00;
     border-left: 7px red solid;
     padding:6px 13px;
}

@media only screen and (max-width: 960px){
     .container{
          width: 60%;
     }
}
#submit{
	padding:8px 35px;
	font-size:20px;
	font-weight:bold;  
	border-radius:15px;
}
		</style>
	</head>

	<body>
		<header>
			<div class="container">
				<h1>Edit Questions</h1>
				<a href="admin.php" class="start">Admin</a>
				<a href="logout.php" class="start">Logout</a>
				
			</div>
		</header>

		<main>
			<div class="container">
				<form method="post" action="">

					<p>
						<label>Question</label>
						<input type="text" name="question" required="" value="<?php echo $question; ?>" disabled >
					</p>
					<p>
						<label>Option 1</label>
						<input type="text" name="choice1" required="" value="<?php echo $answer1; ?>" disabled>
					</p>
					<p>
						<label>Option 2</label>
						<input type="text" name="choice2" required="" value="<?php echo $answer2; ?>" disabled>
					</p>
					<p>
						<label>Option 3</label>
						<input type="text" name="choice3" required="" value="<?php echo $answer3; ?>" disabled>
					</p>
					<p>
						<label>Option 4</label>
						<input type="text" name="choice4" required="" value="<?php echo $answer4; ?>" disabled>
					</p>
					<p>
						<label>Correct answer</label>
						<select name="answer" disabled>
                        <option value="a">Option1 </option>
                        <option value="b">Option2</option>
                        <option value="c">Option3</option>
                        <option value="d">Option4</option>
                    </select>
					</p>
					<p>
						
						<input type="submit" name="submit" value="Delete" id="submit">
					</p>
				</form>
			</div>
		</main>

		

	</body>
</html>








<?php } 
else {
	header("location: admin.php");
}
	ob_end_flush();

?>