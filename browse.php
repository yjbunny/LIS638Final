<?php
	session_start();
	require_once 'includes/header.php';
	require_once 'includes/login.php';
	require_once 'includes/functions.php';
?>

<body class = "allbg">

<div class="navbar">
	<a href="index.php">Home</a>
  	<a class="active" href="browse.php">Browse music by Location</a>
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

<h1><span style = "color: #ffa500">GeoMusic Desktop </span></h1>
<h2>Browse by Location</h2>

<?php

if (isset($_POST['submit'])) { //check if the form has been submitted

	$state = $_POST['state'];
	$query = "SELECT state, city, songTitle, description, songYear, artistLName, artistFName, artistYear     
						  FROM location    
						  LEFT JOIN SongLocation ON location.location_id = SongLocation.location_id    
						  LEFT JOIN song ON SongLocation.song_id = song.song_id    
						  LEFT JOIN artist ON song.artist_id = artist.artist_id 
						  WHERE location.state LIKE '$state' ORDER BY location.city ASC";  

	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
						  
	$result = $conn -> query($query);
	$rows = $result->num_rows;
} 

else {	
    $query = "SELECT state, city, songTitle, description, songYear, artistLName, artistFName, artistYear     
						  FROM location    
						  LEFT JOIN SongLocation ON location.location_id = SongLocation.location_id    
						  LEFT JOIN song ON SongLocation.song_id = song.song_id    
						  LEFT JOIN artist ON song.artist_id = artist.artist_id 
						  WHERE description IS NOT NULL ORDER BY location.state ASC "; 
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	$result = $conn -> query($query);
	$rows = $result->num_rows;

}
?> 

<div class = "tablebox">

<form method="post" action="browse.php">
	<fieldset class="filter">
		<label for="state">Select a state &nbsp; &nbsp;</label>
		<select name="state" class ="dropdown" id="state">
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="DC">District of Columbia</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MS">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>
			<option value="WA">Washington</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>
		</select>
		<input type="submit" name="submit" class="submitState">

	</fieldset>
</form>

	<?php
	echo '<div class = "listtext">';	
	if (isset($_POST['submit'])) {
		echo "Results: ".$state; 
	}
	else {
		echo "All list"; 
	}
	echo "</div>"; 
	
	echo "<table>
			<tr> <th>State</th> <th>City</th> <th>Title</th> <th>Description</th>  <th>Year released</th> <th>Artist</th> <th>Artist year</th> </tr>";

	while ($row = $result->fetch_assoc()) {
		echo '<tr>';
		echo "<td>".$row["state"]."</td>";
		echo "<td>".$row["city"]."</td>";
		echo "<td>".$row["songTitle"]."</td>";
		echo "<td>".$row["description"]."</td>";
		echo "<td>".$row["songYear"]."</td>";
		echo "<td>".$row["artistFName"]." ".$row["artistLName"]."</td>";
		echo "<td>".$row["artistYear"]."</td>";
		echo '</tr>';
	}
	echo "</table>";
	?>


</div>

<?php

include_once 'includes/footer.php';
?>

