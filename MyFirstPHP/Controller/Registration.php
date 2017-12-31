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
        // Enable PHP Session
        if (empty($_SESSION))
            @session_start(); 
        $this->oUtil = new \TestProject\Engine\Util;

        /** Get the Model class in all the controller class **/
        $this->oUtil->getModel('User');
        $this->oModel = new \TestProject\Model\User;
          $this->oUtil->oFields = $this->oModel->getAllFields();
    }
    
     public function register()
    {
         if($_SESSION['is_logged'])
              header('Location: ' . ROOT_URL . '?p=blog&a=add');
        $this->oUtil->getView('RegistrationView');
     
    }
    
     public function add()
    {
        if (!empty($_POST['generateOTP']))
        { 
           
                if (!empty($_POST['phoneNumber']) && strlen($_POST['phoneNumber'])==10) // Allow a maximum of 50 characters
            {
                
                $aData = array('first_name' => "","last_name"=>"","full_name"=>"","email"=>"","createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>"","phone_Number"=>$_POST['phoneNumber']);
               
                if (!$this->oModel->checkUser($aData))
                {
                    
                    // Account details
	$apiKey = urlencode('sblwiGrTClU-HmlcypNlkuiFHbBcthnpMSD4R14pKL');
	
	// Message details
	$numbers = array($_POST['phoneNumber']);
	$sender = urlencode('TXTLCL');
        $OTP=mt_rand(1000,9000);
        $_SESSION["OTP"] = $OTP;
        $_SESSION["PhoneNumber"] = $_POST['phoneNumber'];
	$message='Your one time password for activating your Solve My Doubt account is '.$OTP;
	$message = rawurlencode($message);
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
	//echo $response;
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
                 $this->oUtil->sErrMsg = 'The entered email is already exists';
                  $this->oUtil->getView('RegistrationView');
            } 
            }
            else
            {
                 $this->oUtil->sErrMsg = 'Please enter phone number';
                  $this->oUtil->getView('RegistrationView');
            }
        }
    }
    
    public function GenerateOTP()
    {
           
            if (!empty($_GET['phoneNumber']) && strlen($_GET['phoneNumber'])==10) // Allow a maximum of 50 characters
            {      
                
                $aData = array('first_name' => "","last_name"=>"","full_name"=>"","email"=>"","createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>"","phone_Number"=>$_GET['phoneNumber']);
               
                if (!$this->oModel->checkUser($aData))
                {
                    // Account details
	$apiKey = urlencode('sblwiGrTClU-HmlcypNlkuiFHbBcthnpMSD4R14pKL');
	
	// Message details
	$numbers = array($_GET['phoneNumber']);
	$sender = urlencode('TXTLCL');
        $OTP=mt_rand(1000,9000);
        $_SESSION["OTP"] = $OTP;
        $_SESSION["PhoneNumber"] = $_GET['phoneNumber'];
        $message='Your one time password for activating your Solve My Doubt account is '.$OTP;
	$message = rawurlencode($message);
 
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
         $this->oUtil->oPosts = array(200,"Registered step one successfull",$OTP);
        $this->oUtil->getView('RegistrationStepOne');
                }
                else
                {
                    $this->oUtil->oPosts = array(409,"The entered phone number is already exists",$_GET['phoneNumber']);
                    $this->oUtil->getView('RegistrationStepOne');
                }
        
            }
            else
            {
                 $this->oUtil->oPosts = array(400,"Invalid Request",'');
                  $this->oUtil->getView('RegistrationStepOne');
            } 
    }
    
    public function updateMissingField()
    {
        
        if(isset($_POST['fieldHidden'],$_POST['degreeHidden'],$_POST['specializationHidden'],$_POST['topicGoodHidden'],$_POST['topicHelpHidden'],$_POST['year'],$_POST['sem'])){
          $profilePropertyDef = $this->oModel->getProfilePropertyDef();
          foreach($profilePropertyDef as $profile)
          {
              switch ($profile->PropertyName)
              {
                  case "Field":
                      $aData = array('UserID' => (int)$_SESSION['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_POST['fieldHidden'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "Degree":
                      $aData = array('UserID' => (int)$_SESSION['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_POST['degreeHidden'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "Specialization":
                      $aData = array('UserID' => (int)$_SESSION['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_POST['specializationHidden'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "TopicGoodAt":
                      $aData = array('UserID' => (int)$_SESSION['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_POST['topicGoodHidden'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "TopicNeedHelp":
                      $aData = array('UserID' => (int)$_SESSION['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_POST['topicHelpHidden'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "Year":
                      $aData = array('UserID' => (int)$_SESSION['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_POST['year'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "Sem":
                      $aData = array('UserID' => (int)$_SESSION['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_POST['sem'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
              }
          }
             header('Location: ' . ROOT_URL . '?p=blog&a=all');
                
         
        }
        else
            {
                 $this->oUtil->sErrMsg = 'Please enter mandatory fields';
            }
    }
    
    public function mobileupdateMissingField()
    {
        
        if(isset($_GET['field'],$_GET['degree'],$_GET['specialization'],$_GET['topicGood'],$_GET['topicHelp'],$_GET['year'],$_GET['sem'])){
          $profilePropertyDef = $this->oModel->getProfilePropertyDef();
          foreach($profilePropertyDef as $profile)
          {
              switch ($profile->PropertyName)
              {
                  case "Field":
                      $aData = array('UserID' => (int)$_GET['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_GET['field'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "Degree":
                      $aData = array('UserID' => (int)$_GET['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_GET['degree'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "Specialization":
                      $aData = array('UserID' => (int)$_GET['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_GET['specialization'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "TopicGoodAt":
                      $aData = array('UserID' => (int)$_GET['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_GET['topicGood'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "TopicNeedHelp":
                      $aData = array('UserID' => (int)$_GET['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_GET['topicHelp'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "Year":
                      $aData = array('UserID' => (int)$_GET['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_GET['year'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
                  case "Sem":
                      $aData = array('UserID' => (int)$_GET['userId'],"PropertyDefinitionID"=>$profile->PropertyDefinitionID,"PropertyValue"=>$_GET['sem'],"CreatedOnDate"=>date('Y-m-d H:i:s'),"LastModifiedOnDate"=>date('Y-m-d H:i:s'));
                        $this->oModel->addUserProfile($aData);
                      break;
              }
          }
             $this->oUtil->oPosts = array(200,"Updated successfull",'');
        $this->oUtil->getView('RegistrationStepOne');
                
         
        }
        else
            {
             $this->oUtil->oPosts = array(400,"Invalid Request",'');
                  $this->oUtil->getView('RegistrationStepOne');
            }
    }
    
     public function update()
    {
            if (!empty($_POST['verificationCode']) && $_POST['verificationCode']==$_POST['OTPhidden']) // Allow a maximum of 50 characters
            {
              $hashPassword=  password_hash($_POST['password'] , PASSWORD_BCRYPT, array('cost' => 14));
                $aData = array('first_name' => $_POST['name'],"last_name"=>$_POST['name'],"full_name"=>$_POST['name'],"email"=>$_POST['email'],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>$hashPassword,"phone_Number"=>$_POST['numberhidden']);//,,"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'));
                
                if (!$this->oModel->checkUser($aData))
                {
                     if ($this->oModel->addUser($aData))
                    { 
                         $userData = $this->oModel->checkUser($aData);
                         foreach ($userData as $value) {
                        $_SESSION['email'] = $value->email;
                        if($value->isRegistrationComplete>0)
                        $_SESSION['getUserRegistrationComplete']=1 ;
                        else
                            $_SESSION['getUserRegistrationComplete']=0 ;
                        $_SESSION['userId']= $value->userId;
                         }
                        $_SESSION['is_logged'] = 1;
                       header('Location: ' . ROOT_URL . '?p=blog&a=all');
                    }
                    else
                     {
                         $this->oUtil->sErrMsg = 'Whoops! An error has occurred! Please try again later.';
                        $this->oUtil->getView('CompleteRegistration');
                     }
                }
                else
                {
                    $this->oUtil->sErrMsg = 'The entered email is already exists.';
                    $this->oUtil->getView('CompleteRegistration');
                }
            }
            else
            {
                $this->oUtil->sErrMsg = 'Please enter a valid verification code';
                $this->oUtil->getView('CompleteRegistration');
            } 
    }
    
     public function completeRegistration()
    {
            if (!empty($_GET['verificationCode'])) // Allow a maximum of 50 characters
            {
              $hashPassword=  password_hash($_GET['password'] , PASSWORD_BCRYPT, array('cost' => 14));
                $aData = array('first_name' => $_GET['name'],"last_name"=>$_GET['name'],"full_name"=>$_GET['name'],"email"=>$_GET['email'],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>$hashPassword,"phone_Number"=>$_GET['phoneNumber']);//,,"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'));
                
                if (!$this->oModel->checkUser($aData))
                {
                    if ($this->oModel->addUser($aData))
                    { 
                        $_SESSION['is_logged'] = 1;
                       $this->oUtil->oPosts = array(200,"Registered step one successfull",$_GET['phoneNumber']);
                       $this->oUtil->getView('RegistrationStepOne');
                    }
                    else
                     {
                        $this->oUtil->oPosts = array(500,"Whoops! An error has occurred! Please try again later.",$_GET['phoneNumber']);
                        $this->oUtil->getView('RegistrationStepOne');
                     }
                }
                else
                {
                   $this->oUtil->oPosts = array(409,"The entered email is already exists.",$_GET['phoneNumber']);
                    $this->oUtil->getView('RegistrationStepOne');
                }
            }
            else
            {
                $this->oUtil->oPosts = array(400,"Please enter a valid verification code",$_GET['phoneNumber']);
                $this->oUtil->getView('RegistrationStepOne');
            } 
    }
    
    
            
}
?>
