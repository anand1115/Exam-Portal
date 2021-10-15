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
		<link rel="stylesheet" type="text/css" href="css/student.css">
	</head>

	<body>
		<header>
			<div class="container">
				<h1>Students List</h1>
				<a href="admin.php" class="start">Admin</a>
				<a href="exit.php" class="start">Logout</a>
				
			</div>
		</header>

		
	<h1> All Players</h1>
	<table class="data-table">
		<caption class="title">Student List</caption>
		<thead>
			<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Played On</th>
			<th>Score</th>
			</tr>
		</thead>
		<tbody>
		<?php 
            
            $query = "SELECT * FROM results ORDER BY played_on DESC";
            $select_players = mysqli_query($con, $query) or die(mysqli_error($con));
            if (mysqli_num_rows($select_players) > 0 ) {
            while ($row = mysqli_fetch_array($select_players)) {
                $username = $row['username'];
                $email = $row['email'];
                $played_on = $row['played_on'];
                $score = $row['score'];
                echo "<tr>";
                echo "<td>$username</td>";
                echo "<td>$email</td>";
                echo "<td>$played_on</td>";
                echo "<td>$score</td>";
              
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

