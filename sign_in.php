<?php
session_start();
include_once 'includes/header.php'; 
require_once 'includes/login.php';
require_once 'includes/functions.php';

?>

<body class = "allbg">

<div class="navbar">
	<a href="index.php">Home</a>
  	<a href="browse.php">Browse music by Location</a>
  	<a href="add_song.php">Add music </a>
	<?php
  	if (isset($_SESSION['adminFName']) && isset($_SESSION['adminLName']) ) {
		echo '<a class = "active" href="sign_out.php">sign out </a>';
	}
	else {
		echo '<a class = "active" href="sign_in.php">sign in </a>';
	}
	?>
</div>

<h1><span style = "color: #ffa500">GeoMusic Desktop </span></h1>


<?php 
if (isset($_POST['submit'])) { //check if the form has been submitted
	if ( empty($_POST['email']) || empty($_POST['password']) ) {
		$message = '<p class="error">Please fill out all of the form fields!</p>';
	} 
	
	else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$email = sanitizeMySQL($conn, $_POST['email']);
		$password = sanitizeMySQL($conn, $_POST['password']);			
		$salt1 = "qm&h*";  
		$salt2 = "pg!@";  
		$password = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "SELECT adminFName, adminLName FROM admin WHERE email='$email' AND password='$password'"; 
		$result = $conn->query($query);    
		if (!$result) die($conn->error); 
		$rows = $result->num_rows;

		if ($rows==1) {
			$row = $result->fetch_assoc();
			$_SESSION['adminFName'] = $row['adminFName'];
			$_SESSION['adminLName'] = $row['adminLName'];
			header("Location: add_song.php");
			exit;			
		} 
		
		else {
			$message = '<p class="error">Invalid e-mail/password combination</p>';
		}
	}
}


if (isset($message)) {
	echo $message;
?>
	<h3>Welcome!</h3>
	<fieldset>
	<h5>Sign in to add music </h5>
	<form method="POST" action="#">
	Email <br><input type="text" name="email" size="40" placeholder="e-mail"><br><br>
	Password<br><input type="password" name="password" size="40" placeholder="password"><br>
	<input type="submit" name="submit" value="SIGN IN">
	</form>
	</fieldset>
<?php
}

else { 
?>
	<h3>Welcome!</h3>
	<fieldset>
	<h5>Sign in to add music </h5>
	<form method="POST" action="#">
	Email <br><input type="text" name="email" size="40" placeholder="e-mail"><br><br>
	Password<br><input type="password" name="password" size="40" placeholder="password"><br>
	<input type="submit" name="submit" value="SIGN IN">
	</form>
	</fieldset>
<?php }

?>

<?php include_once 'includes/footer.php'; ?>