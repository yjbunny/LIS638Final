<?php
session_start();
$_SESSION = array();
session_destroy();

require_once 'includes/login.php';
include_once 'includes/header.php'; 
require_once 'includes/functions.php';
?>

<body class = "indexbg">

<div class="navbar">
	<a href="index.php">Home</a>
  	<a href="browse.php">Browse music by Location</a>
  	<a href="add_song.php">Add music </a>
	<a class = "active" href="sign_in.php">sign in </a>
</div>

<h1><span style = "color: #ffa500">GeoMusic Desktop </span></h1>

<h3>You are signed out!</h3>
<h4><span style = "color: white"> Go back to <a href = "index.php"> homepage </a></span></h4>


<?php include_once 'includes/footer.php'; ?>