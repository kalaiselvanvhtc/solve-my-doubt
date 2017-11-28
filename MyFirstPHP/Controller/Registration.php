<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TestProject\Controller;

/**
 * Description of Registration
 *
 * @author kalaiselvan
 */
class Registration {
    //put your code here
    //put your code here
      protected $oUtil, $oModel;
      
       public function __construct()
    {
      
        $this->oUtil = new \TestProject\Engine\Util;

        /** Get the Model class in all the controller class **/
        $this->oUtil->getModel('User');
        $this->oModel = new \TestProject\Model\User;
    }
    
     public function register()
    {
        $this->oUtil->getView('RegistrationView');
     
    }
    
     public function add()
    {
        if (!empty($_POST['generateOTP']))
        { 
           
            if (!empty($_POST['phoneNumber']) && strlen($_POST['phoneNumber'])==10) // Allow a maximum of 50 characters
            {
                
               // $aData = array('first_name' => "","last_name"=>"","full_name"=>"","email"=>"","createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>"","phone_Number"=>$_POST['phoneNumber']);
               
               // if ($this->oModel->checkUser($aData))
               // {
                    
                    // Account details
	$apiKey = urlencode('sblwiGrTClU-HmlcypNlkuiFHbBcthnpMSD4R14pKL');
	
	// Message details
	$numbers = array($_POST['phoneNumber']);
	$sender = urlencode('TXTLCL');
        $OTP=mt_rand(1000,9000);
        $_SESSION["OTP"] = '1234'; //$OTP;
        $_SESSION["PhoneNumber"] = $_POST['phoneNumber'];
	$message = rawurlencode('Your one time password for activating your Solve My Doubt account is 1234');
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;
                    $this->oUtil->getView('CompleteRegistration');
                    $this->oUtil->sErrMsg = 'Hurray!! The post has been added.';
               // }
               // else
               // {
                //    $this->oUtil->sErrMsg = 'Whoops! An error has occurred! Please try again later.';
                 
                 // $this->oUtil->getView('RegistrationView');
              //  }
            }
            else
            {
                 $this->oUtil->sErrMsg = 'Please enter phone number';
                  $this->oUtil->getView('RegistrationView');
            }
        }
    }
    
     public function update()
    {
         echo $_POST['verificationCode'];
         echo $_SESSION["OTP"];
            if (!empty($_POST['verificationCode']) && $_POST['verificationCode']==$_POST['OTPhidden']) // Allow a maximum of 50 characters
            {
              $hashPassword=  password_hash($_POST['password'] , PASSWORD_BCRYPT, array('cost' => 14));
                $aData = array('first_name' => $_POST['name'],"last_name"=>$_POST['name'],"full_name"=>$_POST['name'],"email"=>$_POST['email'],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>$hashPassword,"phone_Number"=>$_POST['numberhidden']);//,,"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'));
                
                if ($this->oModel->checkUser($aData))
                {
                    $_SESSION['is_logged'] = 1;
                    $this->oUtil->getView('add_post');
                }
                else
                    $this->oUtil->sErrMsg = 'Whoops! An error has occurred! Please try again later.';
            }
            else
            {
                $this->oUtil->sErrMsg = 'Please enter a valid verification code';
                $this->oUtil->getView('CompleteRegistration');
                
            } 
        
    }
            
}
?>
