<?php
header("Content-Type:application/json");

   

if (isset($_GET['email'], $_GET['name']))
{
	$price = '';
	require __DIR__ . '/Controller/SocialLogin.php';
                if (User::mobilelogin)
                {
                   response(200,"Registered successfull",$_GET['email']);
                }
                else
                { 
                    response(500,'Whoops! An error has occurred! Please try again later.',$_GET['email']);
                }
	
}
else  if (isset($_GET['email'], $_GET['password']))
        {
            $oModel = new Admin();

            $sHashPassword =  $this->oModel->login($_GET['email']);
            if (password_verify($_GET['password'], $sHashPassword))
            {
                response(200,"Login successfull",$_GET['email']);
            }
            else
            {
               response(400,"Invalid Request",NULL);
            }
        }
        else
            response(400,"Invalid Request",NULL);
function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}