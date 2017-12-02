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
    }
    
     public function login()
    {
        $this->oUtil->getView('SocialLogin');
     
    }
    
   
    
     public  function mobilelogin()
    {
        if (isset($_GET['email'], $_GET['name']))
        {    
                 $hashPassword=  password_hash("1234" , PASSWORD_BCRYPT, array('cost' => 14));
                $aData = array('first_name' => $_GET['name'],"last_name"=>$_GET['name'],"full_name"=>$_GET['name'],"email"=>$_GET['email'],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>$hashPassword,"phone_Number"=>$_GET['email']);//,,"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'));
                
                if ($this->oModel->checkUser($aData))
                {
                 $this->oUtil->oPosts = array(200,"Registered successfull",$_GET['email']);

                 $this->oUtil->getView('LoginApi');  
                }
                else if ($this->oModel->addUser($aData))
                { 
                    $this->oUtil->oPosts = array(200,"Registered successfull",$_GET['email']);

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
            if (password_verify($_GET['password'], $sHashPassword))
            {
                $this->oUtil->oPosts = array(200,"Login successfull",$_GET['email']);
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
        if (!empty($_POST['social_authenticate']))
        {    
            if (!empty($_POST['social_user_info'])) // Allow a maximum of 50 characters
            {
                 $hashPassword=  password_hash("1234" , PASSWORD_BCRYPT, array('cost' => 14));
                $myArray = explode(',', $_POST['social_user_info']);
                $aData = array('first_name' => $myArray[0],"last_name"=>$myArray[0],"full_name"=>$myArray[0],"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'),"password"=>$hashPassword,"phone_Number"=>"124");//,,"email"=>$myArray[1],"createdDate"=>date('Y-m-d H:i:s'),"modifiedDate"=>date('Y-m-d H:i:s'));
                
                if ($this->oModel->checkUser($aData))
                {
                    $_SESSION['is_logged'] = 1;
                    $this->oUtil->getView('add_post');
                    $this->oUtil->sErrMsg = 'Hurray!! The post has been added.';
                }
                else  if ($this->oModel->addUser($aData))
                { 
                     $_SESSION['is_logged'] = 1;
                    $this->oUtil->getView('add_post');
                    $this->oUtil->sErrMsg = 'Hurray!! The post has been added.';
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
            if (password_verify($_POST['password'], $sHashPassword))
            {
                $_SESSION['is_logged'] = 1; // Admin is logged now
                $this->oUtil->getView('add_post');
            }
            else
            {
                $this->oUtil->sErrMsg = 'Incorrect login!';
                $this->oUtil->getView('SocialLogin');
                
            }
        }
        }
        
        
         
        
         
    }
   

}
