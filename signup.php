<?php
  include "connect.php";
  session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<link rel="icon" href="favicon.jpg">
<title>HalpMe – Sign Up</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/signin.css" rel="stylesheet">
	<?php
      if(isset($_SESSION["netid"])  && ($_SESSION["REMOTE_ADDR"] == $_SERVER["REMOTE_ADDR"]))
      {echo '<META http-equiv="refresh" content="0; url=dashboard.php"/>';}
    ?>
</head>
<body>
<div class="container">
	<form class="form-signin" method="post">
		<h1>HalpMe Sign Up</h1>
<h2 class="form-signin-heading">Please fill in details</h2>
<label for="inputNetID" class="sr-only">NetID</label>
<input type="text" id="inputNetID" name="netid" class="form-control" placeholder="NetID" required autofocus>
<br>
<label for="inputPassword" class="sr-only">Password</label>
<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
<br>
<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</form>
</div>

<?php
if(isset($_POST['netid']) && isset($_POST['password'])){
	$stmt = $mysqli->prepare("Select netID from  member");
	$stmt->execute();
	$stmt->bind_result($id);
	$test = true;
	while($stmt->fetch()){
		if ($id == $_POST['netid']){
			$test = false;
			echo "<p> User already exists</p>";
		}
	}
	$stmt->close();
	if($test){
		$encrypted = md5($_POST['password']);
		$stmt = $mysqli->prepare("INSERT INTO member VALUES(?, ?)");
		$stmt->bind_param('ss', $_POST['netid'], $encrypted);
		$stmt->execute();
		$stmt->close();
		echo '<META http-equiv="refresh" content="0; url=index.php"/>';
	}
}
?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>