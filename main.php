<?php
  session_start();
  # destination page where user logout 
  if(isset($_GET['action']) && $_GET['action'] == "logout"){
    unset($_SESSION['username']);
    unset($_SESSION['admin']);
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dinzy-Stock Lookup</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
  .history_row {
    text-align: center;
    margin: 0px, auto;
  }
</style>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="main.php">Dinzy</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="main.php">Home</a>
                    </li>

                    <li>
                        <a href="about.php">About</a>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="trends.php">Trends</a>
                            </li>
							<li>
                                <a href="portfolio.php">Portfolio</a>
                            </li>
                            <li>
                                <a href="ticker.php">Find Ticker</a>
                            </li>
                        </ul>
                    </li>
					<?php 
            # when user login
            if(isset($_SESSION['admin']) && $_SESSION['admin']=='true'){
              echo '<li><a href="main.php">Welcome,'.$_SESSION["username"]. '</a></li>';
              echo '<li><a href="main.php?action=logout">logout</a></li>';
            } else {
              echo '<li><a href="login.php">Login</a></li>';
            } 
          ?> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('image/stock.jpg');"></div>
                <div class="carousel-caption">
                    <a href="trends.php" style="text-decoration: none;"><h2 style="color : white ; "><i>Check Stock Performance</i></h2></a>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('image/ticker.jpeg');"></div>
                <div class="carousel-caption">
                    <a href="ticker.php" style="text-decoration: none;"><h2 style="color : white ; "><i>Find Ticker List</i></h2></a>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('image/portfolio.jpg');"></div>
                <div class="carousel-caption">
                    <a href="portfolio.php" style="text-decoration: none;"><h2 style="color : white ; "><i>Calculate Portfolio ROI</i></h2></a>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center">
                    Stock Lookup
                </h1>
            </div>
            
            <div class="col-md-12 text-center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i> One Click Away To Find Stock Info</h4>
                    </div>
                    <div class="panel-body">
                        <form action="trends.php" class="form-inline" method="GET">
                          <div class="input-group">
                            <input type="text" class="form-control" size="50" placeholder="Stock ticker ex:AAPL" name="ticker">
                            <div class="input-group-btn">
                              <input type="submit" class="btn btn-danger" value="Go">
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
            </div>
        </div>
        



        <hr>



    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })
    </script>

	  <div id="services" class="container-fluid text-center">
	<?php 
    if(isset($_SESSION['admin']) && $_SESSION['admin']=='true'){
      $username = $_SESSION['username'];
      $conn = mysqli_connect("198.91.81.7","nyeungx1_nyeung","run3scap3","nyeungx1_ticker");
      $get_history_query = "SELECT * FROM user_history WHERE username = '$username'";
      $result = mysqli_query($conn, $get_history_query);
      if(!$result){
        echo "<h2>Sorry, we can't connect to your information</h2>";
      } else {
        if (mysqli_num_rows($result)==0){
        echo ' ';
        } else {
          echo '<h2>Recent Browsing History</h2><br>';
          echo '<div class="row slideanim">';
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo '<div class="history_row">';
            echo '<h4><a href="trends.php?ticker='.$row["ticker"].'">'.$row["ticker"].'</a><h4>';
            echo '</div>';
          }
          mysqli_close($conn);
        }       
      }     
    }
  ?>
  </div>
          <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Dinzy 2017</p>
                </div>
            </div>
        </footer>
</body>

</html>
