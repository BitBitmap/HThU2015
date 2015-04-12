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

    <title>HalpMe – Search</title>

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
            <li class="active"><a href="search.php">Search</a></li>
            <li><a href="posts.php">Your Posts</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="logout.php">Logout <span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
	    <form method = 'get' class="form-inline">
			<div class="form-group">
				<label for="sel1">Select Department:</label>
        <?php
        $stmt = $mysqli->prepare("SELECT DISTINCT department from classes");
        $stmt->execute();
        $stmt->bind_result($department);
				echo '<select name="department" class="input-large" id="sel1">';
	        echo "<option value = 'ALL'>Select All</option>";
          while($stmt->fetch()){
            echo "<option value= '".$department."'>".$department."</option>";
          }
          $stmt->close();
          ?>
	  			</select>
			</div>
			<button type="submit" class="btn btn-default">Submit</button>	
	    </form>
	    <br>

      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['department'] == 'ALL'){

        $stmt = $mysqli->prepare("SELECT RID, course, problem FROM request;");
        $stmt->execute();
        $stmt->bind_result($rid, $course, $problem);
        while($stmt->fetch()){
          echo '<a class="btn btn-lg btn-default" href="apost.php?rid='.$rid.'role="button"> Problem in '.$course.': '.$problem.'</a><br>';
        }
        $stmt->close();

      }
      elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $stmt = $mysqli->prepare("select RID, course, problem from classes natural join request where department = ? order by RID DESC;");
        $stmt->bind_param('s', $_GET['department']);
        $stmt->execute();
        $stmt->bind_result($rid, $course, $problem);
        while($stmt->fetch()){
          echo '<a class="btn btn-lg btn-default" href="apost.php?rid='.$rid.'role="button"> Problem in '.$course.': '.$problem.'</a><br>';
        }
        $stmt->close();
      }
      ?>
      <!--<a class="btn btn-lg btn-default" href="#" role="button">Link</a><br>
      <a class="btn btn-lg btn-default" href="#" role="button">Link</a><br>
      <a class="btn btn-lg btn-default" href="#" role="button">Link</a><br>
      -->
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
