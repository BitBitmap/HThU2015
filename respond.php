<?php
  include "connect.php";
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.jpg">

    <title>HalpMe – Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">HalpMe</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="newpost.php">New Post</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="posts.php">Your Posts</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="logout.php">Logout <span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
		<?php 
    $rid = $_GET['rid'];
    echo "<form method='post' action='respond.php?rid=".$rid."'>";
    
		  echo '<textarea class="form-control" rows="8" placeholder="Your response" name="answer"></textarea>';
		  echo '<br>';
		  echo '<button type="submit" class="btn btn-default">Submit</button>';
		echo "</form>";
    echo '</div> <!-- /container -->';
    
    function test($input){
      $input = trim($input);
      $input = stripslashes($input);
      $input = htmlspecialchars($input);
      return $input;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $answer = test($_POST['answer']);
      require 'PHPMailerAutoload.php';
      $mail = new PHPMailer;
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'testnyuhackathon@gmail.com';                   // SMTP username
      $mail->Password = 'nyuhackathon';               // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
      $mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
      $mail->setFrom('testnyuhackathon@gmail.com', 'HalpMe');     //Set who the message is to be sent from
      $mail->addReplyTo($_SESSION['netid'].'@nyu.edu', $_SESSION['netid']);  //Set an alternative reply-to address
      
      $stmt = $mysqli->prepare("SELECT memberID, problem from request where RID = ?");
      $stmt->bind_param('i', $_GET['rid']);
      $stmt->execute();
      $stmt->bind_result($memberID, $problem);
      if($stmt->fetch()){
        $recepemail = $memberID.'@nyu.edu';

        $mail->addAddress($recepemail, $memberID);  // Add a recipient
        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $problem;
        $mail->Body    = $answer;
      }
      if(!$mail->send()) {
         echo 'Message could not be sent.';
         echo 'Mailer Error: ' . $mail->ErrorInfo;
         exit;
      }
      $stmt->close();
      echo '<META http-equiv="refresh" content="0; url=success.php"/>';

    }
    ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
