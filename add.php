<?php session_start();
ob_start(); ?>
<?php include "db.php";
if (isset($_SESSION['username'])) {

if(isset($_POST['submit'])) {
	$question =htmlentities(mysqli_real_escape_string($con , $_POST['question']));
	$choice1 = htmlentities(mysqli_real_escape_string($con , $_POST['choice1']));
	$choice2 = htmlentities(mysqli_real_escape_string($con , $_POST['choice2']));
	$choice3 = htmlentities(mysqli_real_escape_string($con , $_POST['choice3']));
	$choice4 = htmlentities(mysqli_real_escape_string($con , $_POST['choice4']));
	$correct_answer = mysqli_real_escape_string($con , $_POST['answer']);


    $checkqsn = "SELECT * FROM questions";
	$runcheck = mysqli_query($con , $checkqsn) or die(mysqli_error($con));
	$questionno = mysqli_num_rows($runcheck) + 1;

	$query = "INSERT INTO questions(questionno, question , answer1, answer2, answer3, answer4, correct_answer) VALUES ('$questionno' , '$question' , '$choice1' , '$choice2' , '$choice3' , '$choice4' , '$correct_answer') " ;
	$run = mysqli_query($con , $query) or die(mysqli_error($con));
	if (mysqli_affected_rows($con) > 0 ) {
		echo "<script>alert('Question successfully added');
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
		<link rel="stylesheet" type="text/css" href="css/style.css">
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
     padding:6px 13px;
     float:right;
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
     padding:6px 13px;
     float:right;

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
				<h1>Add Questions</h1>
				<a href="Admin.php" class="start">Admin</a>
				<a href="exit.php" class="start">Logout</a>
				
			</div>
		</header>

		<main>
			<div class="container">
				<h2>Add a question...</h2>
				<form method="post" action="">

					<p>
						<label>Question</label>
						<input type="text" name="question" required="">
					</p>
					<p>
						<label>Option 1</label>
						<input type="text" name="choice1" required="">
					</p>
					<p>
						<label>Option 2</label>
						<input type="text" name="choice2" required="">
					</p>
					<p>
						<label>Option 3</label>
						<input type="text" name="choice3" required="">
					</p>
					<p>
						<label>Option 4</label>
						<input type="text" name="choice4" required="">
					</p>
					<p>
						<label>Correct answer</label>
						<select name="answer">
                        <option value="1">Option 1 </option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                    </select>
					</p>
					<p>
						
						<input type="submit" name="submit" value="Submit" id="submit">
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