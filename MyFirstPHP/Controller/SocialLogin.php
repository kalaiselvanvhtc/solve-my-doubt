<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TestProject\Controller;

/**
 * Description of SocialLogin
 *
 * @author kalaiselvan
 */
class SocialLogin {
    //put your code here
      protected $oUtil, $oModel;
      
       public function __construct()
    {
      if (empty($_SESSION))
            @session_start();
        $this->oUtil = new \TestProject\Engine\Util;

        /** Get the Model class in all the controller class **/
        $this->oUtil->getModel('User');
        $this->oModel = new \TestProject\Model\User;
          $this->oUtil->oFields = $this->oModel->getAllFields();
          
          
    }
    
     public function login()
    {
         if($_SESSION['is_logged'])
              header('Location: ' . ROOT_URL . '?p=blog&a=all');
        $this->oUtil->getView('SocialLogin');
     
    }
    
   
    
     public  function mobilelogin()
    {
        if (isset($_GET['email'], $_GET['name']))
        {    
                 $hashPassword=  password_hash("1234" , PASSWORD_BCRYPT, array('cost' => 14));
                $aData = array('first_name' => $_GET['name'],"last_name"=>$_GET['name'],"full_name"=>$_GET['name'],"email"=>$_GET['email'],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>$hashPassword,"phone_Number"=>$_GET['email']);//,,"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'));
                 $userData = $this->oModel->checkUser($aData);
                if ($userData)
                {
                 $this->oUtil->oPosts = array(200,"Registered successfull",$userData);

                 $this->oUtil->getView('LoginApi');  
                }
                else if ($this->oModel->addUser($aData))
                { 
                    $userData = $this->oModel->checkUser($aData);
                    $this->oUtil->oPosts = array(200,"Registered successfull",$userData);

                 $this->oUtil->getView('LoginApi');  
                }
                else
                { 
                     $this->oUtil->oPosts =  array(500,'Whoops! An error has occurred! Please try again later.',$_GET['email']);

                     $this->oUtil->getView('LoginApi');  
                }
        }
        else
        {
              if (isset($_GET['email'], $_GET['password']))
        {
            $this->oUtil->getModel('Admin');
            $this->oModel = new \TestProject\Model\Admin;

            $sHashPassword =  $this->oModel->login($_GET['email']);
            if (password_verify($_GET['password'], $sHashPassword->password))
            {
                $aData = array('first_name' =>"","last_name"=>"","full_name"=>"","email"=>$_GET['email'],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>$hashPassword,"phone_Number"=>$_GET['email']);//,,"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'));
                 $userData = $this->oModel->checkUser($aData);
                $this->oUtil->oPosts = array(200,"Login successfull",$userData);
                $this->oUtil->getView('LoginApi');  
            }
            else
            {
              $this->oUtil->oPosts = array(400,"Invalid Request",'');
              $this->oUtil->getView('LoginApi');  
            }
        }
        else {
                $this->oUtil->oPosts = array(400,"Invalid Request",'');
                $this->oUtil->getView('LoginApi');  
               }
        }
        
    }
    
    public function add()
    {
        try
        {
            if($_SESSION['is_logged'])
              header('Location: ' . ROOT_URL . '?p=blog&a=add');
            
        if (!empty($_POST['social_authenticate']))
        {    
            if (!empty($_POST['social_user_info'])) // Allow a maximum of 50 characters
            {
                 $hashPassword=  password_hash("1234" , PASSWORD_BCRYPT, array('cost' => 14));
                $myArray = explode(',', $_POST['social_user_info']);
                $aData = array('first_name' => $myArray[0],"last_name"=>$myArray[0],"full_name"=>$myArray[0],"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>$hashPassword,"phone_Number"=>"124");//,,"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'));
                $userData = $this->oModel->checkUser($aData);
                $_SESSION['Profilehoto'] = $myArray[2];   
                if ($userData)
                {
                    $_SESSION['is_logged'] = 1;
                  foreach ($userData as $value) {
                        $_SESSION['email'] = $value->email;
                         if($value->isRegistrationComplete>0)
                            $_SESSION['getUserRegistrationComplete']= 1;
                           else 
                            $_SESSION['getUserRegistrationComplete']= 0;
                        $_SESSION['userId']= $value->userId;
                         }
                   header('Location: ' . ROOT_URL . '?p=blog&a=all');
                }
                else  if ($this->oModel->addUser($aData))
                { 
                    $userData = $this->oModel->checkUser($aData);
                     $_SESSION['is_logged'] = 1;
                     foreach ($userData as $value) {
                        $_SESSION['email'] = $value->email;
                            if($value->isRegistrationComplete>0)
                            $_SESSION['getUserRegistrationComplete']= 1;
                           else 
                            $_SESSION['getUserRegistrationComplete']= 0;
            
                        $_SESSION['userId']= $value->userId;
                         }
                   header('Location: ' . ROOT_URL . '?p=blog&a=all');
                }
            }
        }
        else
        {
              if (isset($_POST['email'], $_POST['password']))
        {
            $this->oUtil->getModel('Admin');
            $this->oModel = new \TestProject\Model\Admin;

            $sHashPassword =  $this->oModel->login($_POST['email']);
            if (password_verify($_POST['password'], $sHashPassword->password))
            {
                $_SESSION['Profilehoto'] = "./images/no_avatar.gif"; 
                  $_SESSION['userId'] = $sHashPassword->userId;
                  $_SESSION['email'] = $sHashPassword->email;
                  if($sHashPassword->isRegistrationComplete>0)
                $_SESSION['getUserRegistrationComplete']= 1;
                else 
                $_SESSION['getUserRegistrationComplete']= 0;
            
               $_SESSION['is_logged'] = 1; // Admin is logged now
               header('Location: ' . ROOT_URL . '?p=blog&a=all');
            }
            else
            {
                $this->oUtil->sErrMsg = 'Incorrect login!';
                $this->oUtil->getView('SocialLogin');
                
            }
        }
        }
        }
catch(Exception $e) {
    $this->oUtil->sErrMsg = $e->getMessage();
                $this->oUtil->getView('SocialLogin');
}
        
         
        
         
    }
   

}
