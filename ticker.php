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
                <h1 class="page-header">Find Ticker</h1>
                <ol class="breadcrumb">
                    <li><a href="main.php">Home</a>
                    </li>
                    <li class="active">Ticker</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Intro Content -->
        <div class="row">  
            <div class="col-md-3">
                <div class="well" style="text-align:center;">
                    <?php       
                        $link = mysqli_connect("198.91.81.7","nyeungx1_nyeung","run3scap3","nyeungx1_ticker");

                      

                        if(mysqli_connect_errno()){
                            echo "Failed to connect to MYSQL:".mysqli_connect_error();
                        }
                        
                           $sql = "SELECT * FROM ticker";

                        //execute SQL query 
                        $result = mysqli_query($link,$sql);
                        
                        echo "<legend>"."Ticker Symbol"."<legend><br>";
                       
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            echo '<span class="word"><a href="trends.php?ticker='.$row["symbol"].'">'.$row["symbol"].'</a></span><br>';
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="well" style="text-align:center;">    
                    <?php  
                  
                      $link = mysqli_connect("198.91.81.7","nyeungx1_nyeung","run3scap3","nyeungx1_ticker");

                      

                        if(mysqli_connect_errno()){
                            echo "Failed to connect to MYSQL:".mysqli_connect_error();
                        }
                        
                           $sql = "SELECT * FROM ticker";

                        //execute SQL query 
                        $result = mysqli_query($link,$sql);
                        
                        echo "<legend>"."Company Name"."<legend><br>";
                       
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

                            echo "<span class='word'>".$row["name"]."</span><br>";

                        }
                ?>
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
