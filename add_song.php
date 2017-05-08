<?php
	session_start();
	require_once 'includes/auth.php';
	require_once 'includes/login.php';
	require_once 'includes/functions.php';
	include_once 'includes/header.php';
?>

<body class = "allbg">

<div class="navbar">
	<a href="index.php">Home</a>
  	<a href="browse.php">Browse music by Location</a>
  	<a class = "active" href="add_song.php">Add music </a>
	<?php
  	if (isset($_SESSION['adminFName']) && isset($_SESSION['adminLName']) ) {
		echo '<a href="sign_out.php">sign out </a>';
	}
	else {
		echo '<a href="sign_in.php">sign in </a>';
	}
	?>
</div>

<h1><span style = "color: #ffa500">GeoMusic Desktop </span></h1>

<?php
	if (isset($_SESSION['adminFName']) && isset($_SESSION['adminLName']) ) {
		echo "<h5>Welcome, ".$_SESSION['adminFName']." ".$_SESSION['adminLName'];
		echo " | <small><a href=\"sign_out.php\" style = \"text-decoration: none\"> <span style = \"color: #233b66\"> Sign out</span></a></small></h5>";
		}
?>
	
<h2>1. Add a new song &nbsp; <span style = "color: #bdc4d1"> &nbsp; >>> &nbsp; 2. Link to a location </span></h2>
<h5>You can add a new song and link it to a relevant location. &nbsp;
    Can't find artists or locations you want to link? &nbsp; Email <a href="mailto:ylee60@pratt.edu"><span style = "color: #ffa500">here</span></a>.</h5>
<p class = "comment"> * required field </p>

<?php
if (isset($_POST['submit'])) { //check if the form has been submitted

	if ((empty($_POST['songTitle'])) || (empty($_POST['artist_id'])) ) {
		$message = '<p class="error">Please fill out the required fields </p>';
	} 

	else {

		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
	
		$songTitle = sanitizeMySQL($conn, $_POST['songTitle']);
		$songYear = sanitizeMySQL($conn, $_POST['songYear']);			
		$artist_id = sanitizeMySQL($conn, $_POST['artist_id']);
	
		$query = "INSERT INTO song (song_id, songTitle, songYear, artist_id) VALUES (NULL, \"$songTitle\", $songYear, $artist_id)"; 
		
		$result = $conn->query($query);
	
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
			header("Location: add_description.php"); // appear at the top
		}
	}
}

?>


<div class = "tablebox">

<?php 
	if (isset($message)) echo $message;
?> 

<form method="post" action="add_song.php">

	<fieldset class = "add">
		<label for="songTitle">1. Title *</label>
		<input type="text" name="songTitle" id="songTitle"><br><br>
		
		<label for="songYear">2. Year</label>
		<input type="text" name="songYear" id="songYear"><br><br>
		
		<label for="artist_id">3. Select an artist * &nbsp; &nbsp;</label>
		<select name="artist_id" class ="dropdown" id="artist_id">
			<option value="10">Bon Jovi</option>	
			<option value="13">Boston</option>	
			<option value="2">Bruce Springsteen</option>	
			<option value="12">Bruno Mars</option>	
			<option value="1">Cindy Lauper</option>	
			<option value="3">Extreme</option>	
			<option value="7">Frank Sinatra</option>	
			<option value="4">John Legend</option>	
			<option value="15">Journey</option>
			<option value="11">Justin Timberlake</option>	
			<option value="8">Lady Gaga</option>	
			<option value="5">Nirvana</option>	
			<option value="6">Ramones</option>	
			<option value="9">Taylor Swift</option>	
			<option value="14">Hall and Oates</option>	
			<option value="16">Kanye West</option>	

		</select>
		<br><br>
		<input type="submit" name="submit" value ="Submit" class="submitAddSong">
		<br>
		<a href = "add_description.php" class="linkpage"><p class="linkpage"> Skip this session >> </p></a>
	</fieldset>
</form>

</div>
<?
include_once 'includes/footer.php';
?>