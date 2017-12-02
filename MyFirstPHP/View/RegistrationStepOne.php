<?php
header("Content-Type:application/json");

	header("HTTP/1.1 ".$this->oPosts[0]);
	   
	$response['status']=$this->oPosts[0];
	$response['status_message']=$this->oPosts[1];
	$response['data']=$this->oPosts[2];
	
	$json_response = json_encode($response);
	echo $json_response;
?>
        
        