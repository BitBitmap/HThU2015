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

    <title>Welcome to HalpMe</title>

    <?php
      if(isset($_SESSION["netid"])  && ($_SESSION["REMOTE_ADDR"] == $_SERVER["REMOTE_ADDR"]))
      {echo '<META http-equiv="refresh" content="0; url=dashboard.php"/>';}
    ?>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
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
          <form class="navbar-form navbar-right" method="post">
            <div class="form-group">
              <input type="text" name="netid" placeholder="NetID" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <?php
    if(isset($_POST["netid"]) && isset($_POST["password"]))
    {
      if($stmt = $mysqli->prepare("select netID from member where netID = ? and password = ?"))
      {
        $encrypted = md5($_POST['password']);
        $stmt->bind_param("ss", $_POST["netid"], $encrypted);
        $stmt->execute();
        $stmt->bind_result($netid);
        /* Login is a success. */
        if($stmt->fetch())
        {
          $_SESSION["netid"] = $netid;
          $_SESSION["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"];

          echo '<META http-equiv="refresh" content="0; url=dashboard.php"/>';
        }
        /* Login is a failure. */
        else
        {
          sleep(1);
          echo '<P>Your ID or password is incorrect.</P>';
        }
        $stmt->close();
        $mysqli->close();
      }
    }
      ?>


    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Welcome to HalpMe, NYU!</h1>
        <p>This is a website where you can ask for tutoring help for all of your classes.</p>
        <p><a class="btn btn-primary btn-lg" href="signup.php" role="button">Sign Up &raquo;</a></p>
      </div>
    </div>

    <div class="container">


      <hr>

      <footer>
        <p>&copy; Theta Upsilon 2015</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
