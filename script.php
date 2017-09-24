<?php  
	
	function calcROI($totalInv,$currentVal){
		return  number_format($currentVal - $totalInv,2);
	}

	function calcPercentage($newPrice,$oldPrice){
		$percentage = ($newPrice - $oldPrice)/$oldPrice *100;
		return number_format($percentage,2).'%';
	}

	function currentTickerPrice ($ticker){

		$url = 'http://www.google.com/finance/info?q='.$ticker;
		$return_data = file_get_contents($url);
		$market_data = json_decode(str_replace('//','',$return_data) ,TRUE);
		return $market_data[0]['l'];
	}

	if(strtolower($_SERVER['REQUEST_METHOD']) === 'post')
	{
		
		$str = $_POST["s"];

		$array = explode("\n",$str);
		$ticker = explode(",", $array[0]);
		$shares = explode(",", $array[1]);
		$price = explode(",", $array[2]);
		

		$count = sizeof($ticker);
		if($count < 1){
			echo "null";
			exit;
		}
		$totalInv = 0;
		$currentPrice = 0;
		$currentValue = 0;

		for($i = 0; $i < $count; $i++){
			$currentPrice = currentTickerPrice($ticker[$i]);
			
			$currentValue = $currentValue + $currentPrice * $shares[$i];
			$totalInv = $totalInv + $price[$i] * $shares[$i];
		}

		$ROI  = calcROI($totalInv,$currentValue);
		$percentage = calcPercentage($currentValue,$totalInv);
		$totalInv = number_format($totalInv,2);
		$currentValue = number_format($currentValue,2);
		echo $totalInv." ".$currentValue." ".$ROI." ".$percentage;

	}

	exit;





























?>