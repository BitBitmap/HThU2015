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

  <title>HalpMe – New Post</title>

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
              <li class="active"><a href="newpost.php">New Post</a></li>
              <li><a href="search.php">Search</a></li>
              <li><a href="posts.php">Your Posts</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="logout.php">Logout <span class="sr-only">(current)</span></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
      <?php
      $stmt = $mysqli->prepare("SELECT course FROM classes");
      $stmt->execute();
      $stmt->bind_result($course);
      
      echo "<div class='container'>";

       echo "<form method='post'>";
        echo '<div class="container">';
          echo '<div class="form-group">';
            echo '<label for="sel1">Select course:</label><br>';
            echo '<select name="course" class="input-large" id="sel1">';
            while($stmt->fetch()){
              echo "<option value = '$course'>".$course.'</option>';
            }
            echo "</select>";
            $stmt->close();
          echo '</div>';	
          echo '<br>';
          echo '<div class="form-group">';
            echo '<label for="exampleInputEmail1">Basic Description</label>';
            echo '<input type="text" class="form-control" name="problem" maxlength="100" required>';
          echo '</div>';
          echo '<label for="exampleInputEmail1">Describe Your Problem</label>';
          echo '<textarea class="form-control" rows="6" maxlength="1000" name="description" required></textarea>';
          echo '<br>';
          echo '<button type="submit" class="btn btn-default">Submit</button>';
        echo '</div>';
      echo '</form>';

      function test($input){
      $input = trim($input);
      $input = stripslashes($input);
      $input = htmlspecialchars($input);
      return $input;
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $course = test($_POST['course']);
        $problem = test($_POST['problem']);
        $description = test($_POST['description']);
        $stmt = $mysqli->prepare("INSERT INTO request (`RID`, `course`, `problem`, `description`, `requestdatetime`, `memberID`) VALUES (NULL, ?, ?, ?, current_timestamp, ?);");
        $stmt->bind_param('ssss', $course, $problem, $description, $_SESSION['netid']);
        $stmt->execute();
        $stmt->close();
        echo '<META http-equiv="refresh" content="0; url=success.php"/>';

      }
      ?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
  </html>
