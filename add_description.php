<?php
session_start();

require_once 'includes/auth.php';
include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

?>

<body class = "allbg">

<div class="navbar">
	<a href="index.php">Home</a>
  	<a href="browse.php">Browse music by Location</a>
  	<a class="active" href="add_song.php">Add music </a>
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

<h2><span style = "color: #bdc4d1">1. Add a new song </span> &nbsp; >>> &nbsp; 2. Link to a location</h2>
<h5>You can add a new song and link it to a relevant location. &nbsp;
    Can't find artists or locations you want to link? &nbsp; Email <a href = "mailto:ylee60@pratt.edu"><span style = "color: #ffa500">here</span></a>.</h5>
<p class = "comment"> * required field </p>

<?php

if (isset($_POST['submit'])) { //check if the form has been submitted

	if ((empty($_POST['location_id'])) || (empty($_POST['song_id'])) || (empty($_POST['description'])) ) {
		$message = '<p class="error">Please fill out the required fields </p>';
	} 

	else {

		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
	
		$location_id = sanitizeMySQL($conn, $_POST['location_id']);
		$song_id = sanitizeMySQL($conn, $_POST['song_id']);			
		$description = sanitizeMySQL($conn, $_POST['description']);
	
		$query = "INSERT INTO SongLocation (id, song_id, location_id, description) VALUES (NULL, $song_id, $location_id, \"$description\")"; 
		
		$result = $conn->query($query);
	
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
			$message = '<p><h5> Successfully linked a song to a new location! Browse music <a href = "browse.php"><span style = "color: #ffa500"> here </span></a>.<h5></p>';
		}
	}
}

?>


<div class = "tablebox">

<?php 
	if (isset($message)) echo $message;
?> 

<form method="post" action="add_description.php">

	<fieldset class = "add">
		<label for="location_id">1. Select a location * &nbsp; &nbsp;</label>
		<select name="location_id" class ="dropdown" id="location_id">
			<option value="5">Asbury Park, NJ</option>	
			<option value="2">Baltimore, MD</option>	
			<option value="8">Boston, MA</option>	
			<option value="12">Chicago, IL</option>	
			<option value="9">Houston, TX</option>
			<option value="10">Los Angeles, CA</option>	
			<option value="14">Memphis, TN</option>	
			<option value="1">Morristown, NJ</option>	
			<option value="3">New York, NY</option>	
			<option value="7">Philadelphia, PA</option>	
			<option value="13">Providence, RI</option>	
			<option value="11">San Francisco, CA</option> 
			<option value="6">Seattle, WA</option>	
		</select>
		
		<br><br><br>
	
		<label> 2. Select a song * &nbsp; &nbsp; </label>
		<select name = "song_id" class = "dropdown">
			<!-- populate value using php --> 
			<?php 
				$conn = new mysqli($hn, $un, $pw, $db);
				if ($conn->connect_error) die($conn->connect_error);
				
				$query_pop = "SELECT song_id, songTitle FROM song ORDER BY song.songTitle ASC";
				$result = $conn -> query($query_pop);
 
 				foreach($result as $item) {
 			?>
	 			<option value="<?php echo $item['song_id'] ?>" > <?php echo $item["songTitle"]; ?> </option>
	 			<?php
 					}
 				?>
 		</select>
 	<br><br><br>
 		 
		<label for="description">3. Description *</label>
		<input type="text" name="description" id="description"><br><br>
		
		<input type="submit" name="submit" value ="Submit" class="submitAddSong">
		<a href = "browse.php" class="linkpage"><p class="linkpage"> Skip and Browse Music >> </p></a>
	</fieldset>
</form>

</div>
<?
include_once 'includes/footer.php';
?>