<?php

  session_start();
  
  # record unique user browing history
  if(isset($_SESSION['username']) && isset($_GET['ticker'])){
    include('conn.php');
    $his_username = $_SESSION['username'];
    $his_ticker = strtoupper($_GET['ticker']);
    
    $insert_history_query = "INSERT INTO user_history (username,ticker) VALUES ('$his_username','$his_ticker')";
    
    $check_user = mysqli_query($conn, "SELECT * FROM user_history WHERE username='$his_username' AND ticker='$his_ticker' limit 1");
    
    $check_ticker = mysqli_query($conn, "SELECT symbol FROM ticker WHERE symbol='$his_ticker'");
    
    if (mysqli_fetch_array($check_ticker)){
      if(!mysqli_fetch_array($check_user)){
        mysqli_query($conn,$insert_history_query);
      }    
    } 
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
                <h1 class="page-header">Trends and News</h1>
                <ol class="breadcrumb">
                    <li><a href="main.php">Home</a>
                    </li>
                    <li class="active">Trends</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Intro Content -->
        <div class="row">  
            <div class="col-md-2">
                <div class="well">
                    <!-- /.input-group -->
                    <form action="" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">
                                <legend>Pick a Stock</legend>
                            </div>
                            <div class="form-group">
                                <label for="ticker">Ticker Name</label>
                                <input type="text" required class="form-control" id="ticker" name="ticker" placeholder="Enter a ticker">
                            </div>
                            <div class="form-group">
                                <label for="timespan">Time Span</label>
                                <select id="timespan" name="timespan" class="form-control">
                                    <option>1 Day</option>
                                    <option>5 Days</option>
                                    <option>3 Months</option>
                                    <option>6 Months</option>
                                    <option>1 Year</option>
                                    <option>2 Years</option>
                                    <option>5 Years</option>
                                    <option>Maximum</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="chartType">Chart Type</label>
                                  <select id="chartType" name="chartType" class="form-control">
                                    <option>Line</option>
                                    <option>Bar</option>
                                    <option>Candle</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="log"> Logarithmic Scale
                                </label>
                            </div>
                    
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        
        
            <div class="col-md-6">
                <div class="well">
                    <legend>Summary</legend>
                    <?php
                      
                      
                      if(isset($_GET["ticker"])== true){
                        $ticker = strtoupper($_GET["ticker"]);
                      }
                      else{
                        $ticker = "";
                      }            
                      if(isset($_GET["timespan"])== true){
                        $timespan = $_GET["timespan"];
                      }
                      else{
                        $timespan = "1d";
                      }
                      
                      $csvURL = "http://finance.yahoo.com/d/quotes.csv?s=";
                      if($ticker != ""){
                        $csvURL = $csvURL . $ticker . "&f=nabpomw";
                        $csv = str_getcsv(file_get_contents($csvURL));
                        if($csv[0] == "N/A"){
                            echo "<h3> ticker not found </h3>";
                        }
                        else
                       { echo "<h3>" . $csv[0] . " (".$ticker . ")". "</h3>";
                                       echo "<strong>Prev Close: " . $csv[3] . "</strong><br>";
                                       echo "<strong>Open: " . $csv[4] . "</strong><br>";
                                       echo "<strong>Day's Range: " . $csv[5] . "</strong><br>";
                                       echo "<strong>52wk Range: " . $csv[6] . "</strong><br>";                
                                       echo "<strong>Bid: " . $csv[2] . "</strong><br>";     
                                       echo "<strong>Ask: " . $csv[1] . "</strong><br><br>";}
                         
                      }
                      if ($timespan == "1 Day") {
                        $timespan = "1d";
                      }
                      if ($timespan == "5 Days") {
                        $timespan = "5d";
                      }
                      if ($timespan == "3 Months") {
                        $timespan = "3m";
                      }
                      if ($timespan == "6 Months") {
                        $timespan = "6m";
                      }
                      if ($timespan == "1 Year") {
                        $timespan = "1y";
                      }
                      if ($timespan == "2 Years") {
                        $timespan = "2y";
                      }
                      if ($timespan == "5 Years") {
                        $timespan = "5y";
                      }
                      if ($timespan == "Maximum") {
                        $timespan = "my";
                      }
                      
                      if(isset($_GET["chartType"])== true){
                        $chartType = $_GET["chartType"];
                      }
                      else{
                        $chartType = "l";
                      }
                      if($chartType=="Line"){
                        $chartType = "l";
                      }
                      if($chartType=="Bar"){
                        $chartType = "b";
                      }
                      if($chartType=="Candle"){
                        $chartType = "c";
                      }
                      $log="off";
                      if(isset($_GET["log"])== true)
                        $log = "on";
                      if($ticker != "" && $csv[0] != "N/A")
                        {echo "<img src=\"http://chart.finance.yahoo.com/z?s=". $ticker ."&t=".$timespan."&q=". $chartType ."&l=" . $log. "\">";}
                      if($ticker != ""){
                       echo "<a style=\"display: inline-block;\" href=\"https://finance.yahoo.com/quote/".$ticker."\"><img class=\"img-responsive\" alt=\"YahooFinance\" src=\"image/yahoo.jpg\" width=\"45\" height=\"45\"></a>"; }
                       else{
                        echo "<a style=\"display: inline-block;\" href=\"https://finance.yahoo.com/\"><img class=\"img-responsive\" alt=\"YahooFinance\" src=\"image/yahoo.jpg\" width=\"45\" height=\"45\"></a>";
                       }
                         
                    ?>
                       
                </div>
            </div>

            <div class="col-md-4">
                <div class="well">
            <legend>Latest News </legend>
                <?php 
                   
					if(isset($_GET["ticker"]) and strlen($_GET["ticker"])>= 1) {
						$stock = strtoupper($_GET["ticker"]);
						  }
                    else{
                        $stock = "";
                    }
					
					$csvURL = "http://finance.yahoo.com/d/quotes.csv?s=";
                    if($ticker != ""){
						$csvURL = $csvURL . $ticker . "&f=nabpomw";
                        $csv = str_getcsv(file_get_contents($csvURL));
					}
                    

					
					 
                    
                     $results = PIPHP_GetYahooStockNews($stock);
                    // echo "<br><h3><span id='fetch'>Fetching recent news " .
                    //      "stories for: $stock</span></h3><br /><br />";

					if($csv[0] == "N/A" or !$results[0]){
						if(isset($_GET["ticker"])){
						echo "<h3> not found</h3>";}
                    }
                    else
                    {
                    #   echo "<a href='http://finance.yahoo.com/q?s=$stock'>"."<img src='" . $results[1][0] . "' border='1' />" . '</a><br /><br />';
                       
                        foreach($results[2] as $result){
                            echo "<a href='$result[4]'>$result[0]</a><span> ---$result[2]</span>" .
                            "<br />$result[3]" .
                            '<br /><br />';
                        }
                    }


                    function PIPHP_GetYahooStockNews($stock)
                    {

                        $stock = strtoupper($stock);
                        $url   = 'http://finance.yahoo.com';
                        $check = file_get_contents("$url/q?s=$stock");
                        
                        if (stristr($check, 'Invalid Ticker Symbol') || $check == '')
                            return array(FALSE);
                        $reports = array();
                        $xml     = file_get_contents("$url/rss/headline?s=$stock");
                        $xml     = preg_replace('/&lt;\/?summary&gt;/', '', $xml);
                        $xml     = preg_replace('/&lt;\/?image&gt;/',   '', $xml);
                        $xml     = preg_replace('/&lt;\/?guid&gt;/',    '', $xml);
                        $xml     = preg_replace('/&lt;\/?p?link&gt;/',  '', $xml);
                        $xml     = str_replace('&lt;![CDATA[',          '', $xml);
                        $xml     = str_replace(']]&gt;',                '', $xml);
                        $xml     = str_replace('&amp;',      '[ampersand]', $xml);
                        $xml     = str_replace('&',                '&amp;', $xml);
                        $xml     = str_replace('[ampersand]',      '&amp;', $xml);
                        $xml     = str_replace('<b>',          '&lt;b&gt;', $xml);
                        $xml     = str_replace('</b>',        '&lt;/b&gt;', $xml);
                        $xml     = str_replace('<wbr>',      '&lt;wbr&gt;', $xml);
                        $sxml    = simplexml_load_string($xml);

                        foreach($sxml->channel->item as $item){
                            $flag  = FALSE;
                            $url   = $item->link;
                            $title = $item->title;
                            $temp  = explode(' (', $title);
                            $title = $temp[0];
                            $site  = str_replace(')', '', $temp[0]);
                            $site  = str_replace('at ', '', $site);
                            $desc  = $item->description;
                            $date  = date('M jS, g:ia',
                            strtotime(substr($item->pubDate, 0, 25)));
                           
                            for ($j = 0 ; $j < count($reports) ; ++$j){
                                similar_text(strtolower($reports[$j][0]),
                                strtolower($title), $percent);
                                if ($percent > 70){
                                    $flag = TRUE;
                                    break;}
                            }
                            if (!$flag && !strstr($title, '[$$]') && strlen($desc)){
                                $reports[] = array($title, $site, $date, $desc, $url);
                            }
                        }
                        $url1 = "http://ichart.finance.yahoo.com/t?s=$stock";
                        $url2 = "http://ichart.finance.yahoo.com/b?s=$stock";
                        return array(count($reports), array($url1, $url2), $reports);
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
