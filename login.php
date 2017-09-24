<?php
  session_start();
  
  if(isset($_GET['action']) && $_GET['action'] == "logout"){
    unset($_SESSION['username']);
    exit('Successful logout!<br> <a href="login.php"> click to login</a>');
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
    #welcomeback {
      margin: 0px, auto;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }
    
  </style>
  
  <body>
    <script>
      function InputCheck(thisForm){
        if(thisForm.username.value == "" && thisForm.password.value == ""){
          alert("Must input username and password");
          return (false);
        }
        if(thisForm.username.value == ""){
          alert("Must input username");
          return (false);
        }
        if(thisForm.password.value == ""){
          alert("Must input password");
          return (false);
        }
        var user_contr = /^[a-zA-Z0-9_]{1,}$/;
        if(!thisForm.username.value.match(user_contr)){
          alert("Username can only contain letters, numbers and underscores");
          return (false);
        }
        if(String(thisForm.password.value).length < 6){
          alert("Password must be at least 6 characters");
          return (false);
        }
      } 
    </script>
  
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


  
  <div class="container"> 
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Login</h1>
          </div>
      </div>
      <div id="hid">
        <form name="LoginForm" method="post" action="login.php" onsubmit="return InputCheck(this)">
        <div class="form-group">
          <label for="Username:">Username: </label>
          <input class="form-control" type="text" name="username" placeholder="username">
        </div>
        <div class="form-group">
          <label for="password:">Password: </label>
          <input class="form-control" type="password" name="password" placeholder="password">
        </div>
        <p>
          <input type="submit" name="submit" value="Submit"> 
        </p>
        <p>
          New User? <a href="reg.php">Create one</a>
        </p>
      </div>
      <span>    
      
      <?php
      
      if(!empty($_POST)){
        
        $posts = $_POST;
        foreach ($posts as $key => $value){
          $posts[$key] = trim($value);
        }
        $username = $posts["username"];
        $password = MD5($posts["password"]);
  
        include('conn.php');
  
        $check_query = "select * from user where username = '$username' and password = '$password'";
  
        $result = mysqli_query($conn, $check_query);
        if(mysqli_fetch_array($result, MYSQLI_ASSOC)){
          $_SESSION["username"]= $username;
          $_SESSION["admin"]='true';
          
          echo '<script>document.getElementById("hid").style.visibility = "hidden";</script>';
          
          echo "<div id='welcomeback'>".$username.", Welcome back!  ";
          echo '<a href="main.php">Click to Main Page</a><br></div>';
          

        } else {
          echo '<font color="red">***Fail to find your login information, please try again</font></div>';
          exit();
        }
      }
      ?>
      </span>
  </div>
  </body>
</html>