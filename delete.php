<html>
<head>
	<title>Delete</title>
</head>

<body><?php
session_start();
include "connect.php";

echo "You have succesfully deleted the event";
$stmt = $mysqli->prepare("DELETE FROM request WHERE RID = ?");
$stmt->bind_param('i', $_GET['rid']);
$stmt->execute();
$stmt->close();

echo '<META http-equiv="refresh" content="1; url=posts.php"/>';

?></body>
</html>