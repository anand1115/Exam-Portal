<?php session_start();
      ob_start();
      require('db.php');
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
          $phno = $_POST["phno"];
	$email = $_POST["email"];
	$text = $_POST["texta"];
	        $query = "INSERT into `contact` (email,phonenumber,message)
VALUES ('$email', '$phno','$text')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<script>alert('Than you...Contact You Soon')</script>";
      }
  }
 ?>
<html>
<head>
    <link rel="stylesheet" href="css/index.css">
    </head>
<body>
<div class="main_container" id="home">
	<?php include('header.php') ?>


	<div class="banner_image">
		<div class="banner_content">
			<h2 style="margin-bottom:30px;font-size:50px;color:green">Welcome <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?> </h2>
			<h1>Fouses Exams<br/>
				<span></span>
			</h1>
			<p>This is online exam based on what we have learnt till now!!</p>
			<a id="button" href="<?php if(isset($_SESSION['username'])){echo 'quizstart.php';}else{echo 'login.php';}?>">Lets Go</a>
		</div>
	</div>

	<div class="about" id="about">
		<h1 class="title">About us</h1>
		<p>We at FOUSES offers Website designing and development including Blog Websites, Business Websites, E-Commerce Websites, Website Maintenance, Website Redesigning and development at affordable cost with high power hostings from BigRock and Digital Marketing Services for Local Business Promotions, Youtube Promotions and Full Startup Business Promotions at very low cost.Website
https://www.fouses.com  Industries Information Technology and Services</p>
		<div class="btn"><a href="#">Learn More</a></div>
	</div>

	<div class="services" id="services">
		<h1 class="title">Our Services</h1>
		<p>#digitalmarketing #marketing #fousesindia #fouses #internship #workfromhome #webdesign #onpageseo #offpageseo #webdevelopment #datastructures #java #machinelearning #datanalytics #wordpress #studyonline #python #summerinternship</p>

		<div class="diff_services">
			<div class="diff_service_item">
				<img src="https://i.imgur.com/wyeA7Ct.png" alt="Service_image">
				<h3>Web Development</h3>
				
			</div>
			<div class="diff_service_item">
				<img src="https://i.imgur.com/zOqXKNN.png" alt="Service_image">
				<h3>App Development</h3>
				
			</div>
			<div class="diff_service_item">
				<img src="https://i.imgur.com/TLy9GMu.png" alt="Service_image">
				<h3>PSD to HTML</h3>
				
			</div>
		</div>
	</div>

	<div class="contactus" id="contactus">
		<h1 class="title">Contact Us</h1>
		<form method='POST' action='index.php'>
		<div class="form_wrapper">
			<div class="form_input">
				<input type="text" placeholder="Email" name='email' required>
			</div>
			<div class="form_input">
				<input type="text" placeholder="phonenumber" name='phno' required>
			</div>
			<div class="form_input">
				<textarea placeholder="Message" name='texta' required></textarea>
			</div>
			<div class="btn">
				<input type="submit" name="submit" value='Send'>
			</div>
			</form>
		</div>
	</div>

	<div class="ourteam" id="ourteam">
		<h1 class="title">our team</h1>
		<div class="ourteam_wrapper">
			<div class="team-1 team">
				<div class="team_member">
					<img src="https://i.imgur.com/DFZPOdT.jpg" alt="Team_Image">
				</div>
				<div class="team_member">
					<img src="https://i.imgur.com/GionYfa.jpg" alt="Team_Image">
				</div>
				<div class="team_member">
					<img src="https://i.imgur.com/fesdHmx.jpg" alt="Team_Image">
				</div>
			</div>
		</div>
	</div>

	<div class="arrow">
		<a href="#home"><img src="https://i.imgur.com/wre6n0O.png" alt="up_arrow"></a>
	</div>
</div>
    </body>
</html>


<?php ob_end_flush(); ?>