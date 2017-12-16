<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TestProject\Controller;

/**
 * Description of UserProfile
 *
 * @author kalaiselvan
 */
class UserProfile {
    //put your code here
     protected $oUtil, $oModel;
      
       public function __construct()
    {
           // Enable PHP Session
        if (empty($_SESSION))
            @session_start();

               
        $this->oUtil = new \TestProject\Engine\Util;

        /** Get the Model class in all the controller class **/
        $this->oUtil->getModel('UserProfile');
        $this->oModel = new \TestProject\Model\UserProfile;
        $this->oUtil->oFields = $this->oModel->getAllFields();
         
    }
    
    public function getuserinfo()
    {
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);
         $this->oUtil->oUserInfo = $this->oModel->getUserInfo($_SESSION['userId']);
        $this->oUtil->getView('UserProfile');
     
    }
    
    public function mobilegetuserinfo()
    {
        if(isset($_GET['userId']))
        {
          $this->oUtil->oPosts = array(200,"User Information",$this->oModel->getUserInfo($_GET['userId']));
            $this->oUtil->getView('UserProfileApi');
        }
 else {
     
                $this->oUtil->oPosts = array(400,"Invalid Request",'');
                $this->oUtil->getView('UserProfileApi');  
               
 }
     
    }
    
    protected function isLogged()
    {
        return !empty($_SESSION['is_logged']);
    }
}
