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
    <script
      src="https://code.jquery.com/jquery-2.2.4.min.js"
      integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous">
        
    </script>

    <script type="text/javascript">
        
        $(function()
        {
            $(".display-panel").hide();
            $(document).on('click','button',function()
            {

                var ticker = [];
                var shares = [];
                var price = [];
                $("input[name='ticker[]'").each(function() {
                    ticker.push($(this).val());
                });
                $("input[name='shares[]'").each(function() {
                    shares.push($(this).val());
                });
                $("input[name='price[]'").each(function() {
                    price.push($(this).val());
                });
                
                var str = ticker +"\n"  + shares + "\n" + price;

                $.post('script.php',{s:str},function(response)
                                        {
                                            
                                            $(".display-panel").show();
                                            var results = response.split(" ");
                                            if(results[0] === "<br"){
                                                $(".display-panel").hide();
                                                alert("I SPENT A LOT OF TIME OF THIS ! ENTER SOMETHING ! OR REMOVE IT !");
                                            }
                                            $("#totalInv").text(results[0]);
                                            $("#currentValue").text(results[1]);
                                            $("#ROI").text(results[2]);
                                            $("#percentage").text(results[3]);

                                        });
            });


            var counter = 1;


            $("#addButton").click(function () {

                if(counter>10){
                        alert("Only 10 textboxes allowed");
                        return false;
                }

                var newTextBoxDiv = $(document.createElement('div'))
                     .attr("id", 'TextBoxDiv' + counter);

                newTextBoxDiv.after().html("<div class =\"col-md-6 form-calc-panel\"><div class=\"well\"><ul class=\"list-group\"><li class=\"list-group-item\"><label>Ticker symbol:</label><input type=\"text\" class=\"form-control\" name=\"ticker[]\" value=\"\"/></li><li class=\"list-group-item\"><label>number of shares:</label><input type=\"text\" class=\"form-control\" name=\"shares[]\" value=\"\"/></li><li class=\"list-group-item\"><label>Purchased price:</label><input type=\"text\" class=\"form-control\" name=\"price[]\" value=\"\"/></li></ul></div></div>");

                newTextBoxDiv.appendTo('#row_form');


                counter++;
             });

             $("#removeButton").click(function () {
                if(counter==1){
                      alert("No more textbox to remove");
                      return false;
                   }
                counter--;
                $("#TextBoxDiv" + counter).remove();

             });

        });

    </script>

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
                    <h1 class="page-header">Portfolio Calculator</h1>
                    <ol class="breadcrumb">
                        <li><a href="main.php">Home</a>
                        </li>
                        <li class="active">Portfolio</li>
                    </ol>
                </div>
            </div>
        <!-- /.row -->

        <!-- Intro Content -->
            <div class="row">
                <div class="col-md-3">
                    <div class="well" style="background-image:url('image/portfolio.jpg');" >
                        <h4>Build Portfolio:</h4>
                        <div class="input-group">
                        	<br><br><br><br><br><br><br><br><br>
                            <input class="btn btn-danger" type='button' value='ADD+' id='addButton'>
                            <input class="btn btn-info" type='button' value='REMOVE-' id='removeButton'>
                            <button type = "button" class="btn btn-primary btn-block" id="submit">Submit</button>
                            
                        </div>
                        <!-- /.input-group -->
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="well display-panel">
                        <ul class="list-group" style="background-color:#c1dae6; text-align: center;">
                            <li class="list-group-item" style="background-color:transparent;">
                                <label>Total investment:</label>
                                <div id = "totalInv"></div>
                            </li>
                            <li class="list-group-item" style="background-color:transparent;">
                                    <label>Current value:</label>
                                    <div id = "currentValue"></div>
                            </li>
                            <li class="list-group-item" style="background-color:transparent;">
                                    <label>ROI:</label>
                                    <div id = "ROI"></div>
                            </li>
                            <li class="list-group-item" style="background-color:transparent;">
                                    <label>Percentage:</label>
                                    <div id = "percentage"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class = 'row' id = 'row_form'>
            	<div class ="col-md-6 form-calc-panel">
            		<div class="well">
            			<ul class="list-group">
	            			<li class="list-group-item">
	            				<label>Ticker symbol:</label>
	            				<input type="text" class="form-control" name="ticker[]" value=""/>
	            			</li>
	            			<li class="list-group-item">
	            				<label>number of shares:</label>
	            				<input type="text" class="form-control" name="shares[]" value=""/>
	            			</li>
	            			<li class="list-group-item">
	            				<label>Purchased price:</label>
	            				<input type="text" class="form-control" name="price[]" value=""/>
	            			</li>
            			</ul>
            		</div>
            	</div>
            </div>

        <!-- /.row -->

           

        <!-- Footer -->
            <footer>
            	<hr>
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
