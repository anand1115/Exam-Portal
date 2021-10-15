<?php session_start();
ob_start(); ?>
<?php include "db.php";
if (isset($_SESSION['username']) && $_SESSION['username']=='admin') {
?>
<html>
<head>
  <style>
  * {
     margin:0;
     padding:0;
     box-sizing:border-box;
     list-style:none;
     text-decoration:none;
   }
   body {
     background:#f3f5f9;
   }
   .wrapper {
     display:flex;
     position:relative;
   }
   .wrapper .sidebar {
     position:fixed;
     width:200px;
     height:100vh;
     background:#4b4276;
     padding:30px 0;
   }
   .wrapper .sidebar h2{
     color:#fff;
     text-transform:uppercase;
     text-align:center;
     margin-bottom:30px;
   }
   .wrapper .sidebar h2 a{
    color:white;
   }
   .wrapper .sidebar ul li {
     padding:15px;
     border-bottom:1px solid rgba(0,0,0,0.05);
     border-top:1px solid rgba(225,225,125,0.05);
     font-weight:bold;
     text-align:center;
   }
   .wrapper .sidebar ul li a {
     color:#bdb8d7;
     display:block;
   }
   .wrapper  .sidebar  ul li:hover {
     background:#594f8d;
   }
   .wrapper  .sidebar  ul li:hover a {
     color:#fff;
   }
   .wrapper  .main_content {
     width:100%;
     margin-left:200px;
   }
   .main_content  .header {
     padding:30px;
     background:white;
     color:#fff;
     border:5px solid #e0e4e8;
     text-align:center;
     font-size:50px;
     font-weight:bolder;
   }
   td{
    border:5px solid red;
    padding:10px
   }
   a:active{
    color:blue;
   }
   a:visited{
    color:blue;
   }
   .wrapper  .info {
     color:green;
     text-align:center;
   }
</style>
</head>
<body>
  <div class="wrapper">
   <div class="sidebar">
    <h2><a href="index.php">Home</a></h2>
    <ul>
     <li><a href="#" class="fas">Edit Questions</a></li>
     <li><a href="add.php" class="fas">Add Questions</a></li>
     <li><a href="deletequestion.php" class="fas">Delete Questions</a></li>
     <li><a href="students.php" class="fas">See Results</a></li>
     <!-- <li><a href="#" class="fas">Reviews</a></li> -->
     <li><a href="reviews.php" class="fas">Reports</a></li>
     <li><a href="logout.php" class="fas">Logout</a></li>
     <!-- <li><a href="#" class="fas">Change Password</a></li> -->
    </ul>
   </div>
   <div class="main_content">
    <div class="header">
      <table class="data-table">
    <caption class="title">All questions</caption>
    <thead>
      <tr>
        <th>Q.NO</th>
        <th>Question</th>
        <th>Option1</th>
        <th>Option2</th>
        <th>Option3</th>
        <th>Option4</th>
        <th>Correct Answer </th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
        
        <?php 
            
            $query = "SELECT * FROM questions ORDER BY questionno";
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
                echo "<td> <a href='edit.php?questionno=$questionno'> Edit </a></td>";
              
                echo "</tr>";
             }
         }
        ?>
  
    </tbody>
    
  </table>
      
    </div>
    <div class="info">
    </div>
  </div>
</body>
</html>
<?php } 
else {
  header("location: admin.php");
}
ob_end_flush();
?>
