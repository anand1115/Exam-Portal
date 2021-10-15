<?php session_start();
ob_start(); ?>
<?php 
include "db.php";
if (isset($_SESSION['username']) && $_SESSION['username']=='admin') {
}
else {
	header("location: admin.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Quiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style1.css">
	</head>

	<body>
		<header>
			<div class="container">
				<h1>Delete Questions</h1>
				<a href="Admin.php" class="start">Admin</a>
				<a href="exit.php" class="start">Logout</a>
				
			</div>
		</header>

		
	<h1> All Questions</h1>
	<table class="data-table">
		<caption class="title">All questions</caption>
		<thead>
			<tr>
				<th>Q.NO</th>
				<th>Question</th>
				<th>Option 1</th>
				<th>Option 2</th>
				<th>Option 3</th>
				<th>Option 4</th>
				<th>Correct Answer </th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
        
        <?php 
            
            $query = "SELECT * FROM questions ORDER BY questionno DESC";
            $select_questions = mysqli_query($con, $query) or die(mysqli_error($con));
            if (mysqli_num_rows($select_questions) > 0 ) {
            while ($row = mysqli_fetch_array($select_questions)) {
                $questionno = $row['questionno'];
                $question = $row['question'];
                $option1 = $row['answer1'];
                $option2 = $row['answer2'];
                $option3 = $row['answer3'];
                $option4 = $row['answer4'];
                $Answer = $row['correct_answer'];
                echo "<tr>";
                echo "<td>$questionno</td>";
                echo "<td>$question</td>";
                echo "<td>$option1</td>";
                echo "<td>$option2</td>";
                echo "<td>$option3</td>";
                echo "<td>$option4</td>";
                echo "<td>$Answer</td>";
                echo "<td> <a href='delete.php?questionno=$questionno'> delete </a></td>";
              
                echo "</tr>";
             }
         }
        ?>
	
		</tbody>
		
	</table>
</body>
</html>

<?php 
	ob_end_flush();

?>


