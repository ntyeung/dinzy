<!DOCTYPE html>
<html>
  <head>
    <title>Customer Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
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
        if(thisForm.repass.value == ""){
          alert("Must re-input password");
          return (false);
        }
        var user_contr = /^[a-zA-Z0-9_]{1,}$/;
        if(!thisForm.username.value.match(user_contr)){
          alert("Invalid Username");
          return (false);
        }
        if(String(thisForm.password.value).length < 6){
          alert("Password must be at least 6 characters");
          return (false);
        }
        if(thisForm.password.value != thisForm.repass.value){
          alert("Please input same password");
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
              <br><br>
              <h1 class="page-header">Sign Up</h1>
          </div>
      </div>
      <div id="hid">
      <form name="LoginForm" method="post" action="reg.php" onsubmit="return InputCheck(this)">
        <div class="form-group">
        <label for="Username:">Username:</label>
        <input class="form-control" type="text" name="username" placeholder="username"><span> * Username can only contain letters, numbers and underscores</span>
        </div>
        <div class="form-group">
        <label for="password:">Password: </label>
        <input class="form-control" type="password" name="password" placeholder="password"><span> * Password should be at least 6 characters for better security </span>
        </div>
        <div class="form-group">
        <label for="repass:">Re-Password: </label>
        <input class="form-control" type="password" name="repass" placeholder="Re-input password">
        </div>
        <p>
        <input type="submit" name="submit" value="Submit">  
        <a href="login.php"> login </a>
      </div>
      </p>
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

        $check_query = mysqli_query($conn, "select * from user where username='$username' limit 1");
        
        if(mysqli_fetch_array($check_query)){
          echo '<font color="red">***Sorry, username '.$username.' existed. <a href="javascript:history.back();">Please try another username</a>';
          exit;
        } else {
          $insert_sql = "INSERT INTO user(username,password)VALUES('$username','$password')";

          if(mysqli_query($conn,$insert_sql)){
            echo '<script>document.getElementById("hid").style.visibility = "hidden";</script>';
            echo "<div id='welcomeback'>Successfully Registration!! <a href='login.php'>Please login</a>";
          } else {
            echo '***Sorry, failed registration';
            echo 'Please try again<a href="reg.php;">return</a>';
          } 
        }     
      }

      ?>
      </span>
    </div>
  </body>