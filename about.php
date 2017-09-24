<?php
  session_start();
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

<body>

    <!-- Navigation -->
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

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">About Us</h1>
                <ol class="breadcrumb">
                    <li><a href="main.php">Home</a>
                    </li>
                    <li class="active">About</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Intro Content -->
        <div class="row">
            <div class="col-md-6">
                <img class="img-responsive" src="image/logo.jpg" alt="">
            </div>
            <div class="col-md-6">
                <h2>About Dinzy</h2>
                <p>Dinzy is a website that allows quick lookup of stock information such as price and current news to keep you up to date. We also provide portfolio calculations to help you quickly determine how much you have gained(or lost >.<) on your investment.</p>
                <p>If you cannot find a ticker, you can also go to our Ticker/Index page to find a list of all the tickers.</p>
                <p>If you have any questions, please feel free to email us at info@dinzy.com, but before that please donate so we can purchase an email server</p>
            </div>
        </div>
        <!-- /.row -->
		<br><br><br><br>
        <!-- Team Members -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Our Team</h2>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" src="image/nick.jpg" alt="">
                    <div class="caption">
                        <h3>Nicholas Yeung<br>
                            <small>Web designer</small>
                        </h3>
                        <p>Contact: nyeung@scu.edu</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                        <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" src="image/zexi.jpg" alt="">
                    <div class="caption">
                        <h3>Zexi(Jesse) Zhang<br>
                            <small>Web designer</small>
                        </h3>
                        <p>Contact: zzhang4@scu.edu</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                        <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" src="image/dixu.jpg" alt="">
                    <div class="caption">
                        <h3>Di Xu<br>
                            <small>Web designer</small>
                        </h3>
                        <p>Contact: dxu1@scu.edu</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                        <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" src="image/yixin.jpg" alt="">
                    <div class="caption">
                        <h3>Yixin Sun<br>
                            <small>Web designer</small>
                        </h3>
                        <p>Contact: ysun@scu.edu</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        <!-- /.row -->

        
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Dinzy 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
