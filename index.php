<?php
	session_start();
	require_once './includes/header.php';
	require_once 'includes/login.php';
?>
<body class = "indexbg">


<div class="navbar">
	<a class="active" href="index.php">Home</a>
  	<a href="browse.php">Browse music by Location</a>
  	<a href="add_song.php">Add music </a>
	<?php
  	if (isset($_SESSION['adminFName']) && isset($_SESSION['adminLName']) ) {
		echo '<a href="sign_out.php">sign out </a>';
	}
	else {
		echo '<a href="sign_in.php">sign in </a>';
	}
	?>
	
</div>

<h1>GeoMusic Desktop</h1>

<!-- <body background="./image/bw.jpg"> --> 

<div class = "intro"> 
<p> <span style = "color: #ffa500">GEO MUSIC DESKTOP</span> is a database website where users can designate songs to certain locations. <br>
For example, the song "Lights" by Journey can be linked to "San Francisco" since it is a song about San Francisco and played often at San Francisco Giants baseball games. 
You can also <a href = "browse.php" style ="text-decoration: none"><span style = "color: #ffa500"> browse music by location </span></a>. 
<br><br>
This website was created using html, css, php, and mysql, as a final project for my Web Development class at 
<a href = "http://pratt.edu" style = "text-decoration: none" target="_blank"><span style = "color: #ffa500"> Pratt Institute. </span></a>
</p>
<br>

<p>If you have any inquiries, please email <a href="mailto:ylee60@pratt.edu" style = "text-decoration: none"><span style = "color: #ffa500">here</span></a>.</p>
<br>
<p> Image credit: "Rush - Time Stand Still" (<a href = "https://geekdad.com/2016/11/time-stand-still-rush/" target="_blank"> https://geekdad.com/2016/11/time-stand-still-rush/</a>) 
</div>
<?php
include_once './includes/footer.php';
?>


