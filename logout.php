<html>
<head>
	<title>Logout</title>
</head>

<body><?php
echo "You are now logged out <br>";
echo '<META http-equiv="refresh" content="1; url=index.php"/>';

session_start();
session_destroy();

?></body>
</htm>