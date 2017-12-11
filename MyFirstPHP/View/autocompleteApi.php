<?php
header("Content-Type:application/json");

	header("HTTP/1.1");
	 
	$json_response = json_encode($this->objAuto);
	echo $json_response;
?>
        
        