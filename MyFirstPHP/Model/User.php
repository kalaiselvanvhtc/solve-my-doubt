<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TestProject\Model;

/**
 * Description of User
 *
 * @author kalaiselvan
 */
class User {
    
    //put your code here
    protected $oDb;
    protected $userTbl ='users';
    public function __construct()
    {
        $this->oDb = new \TestProject\Engine\Db;
    }
     public function getUserRegistrationComplete($sEmail) 
    {
        
        $oStmt = $this->oDb->prepare('SELECT isRegistrationComplete FROM users WHERE email = :email OR phone_Number = :email LIMIT 1');
        $oStmt->bindValue(':email',$sEmail, \PDO::PARAM_STR);
        $oStmt->execute();
        $oRow = $oStmt->fetch(\PDO::FETCH_OBJ);

        return @$oRow->isRegistrationComplete; // Use the PHP 5.5 password function
    }
    
        
    function checkUser($userData){
        
        if(!empty($userData)){
            // Check whether user data already exists in database
             $oStmt = $this->oDb->prepare('SELECT * FROM users WHERE email = :email OR phone_Number = :phone_Number');
        $oStmt->bindParam(':email', $userData['email'], \PDO::PARAM_STR);
        $oStmt->bindParam(':phone_Number', $userData['phone_Number'], \PDO::PARAM_STR);
        $oStmt->execute();
        $userData = $oStmt->fetchAll(\PDO::FETCH_OBJ);
        }
        
        // Return user data
        return $userData;
    }
    
    function addUser($userData){
        
        if(!empty($userData)){
            // Check whether user data already exists in database

            $prevQuery = $this->oDb->prepare('SELECT * FROM users WHERE email = :email OR phone_Number = :phone_Number');
        $prevQuery->bindParam(':email', $userData['email'], \PDO::PARAM_STR);
        $prevQuery->bindParam(':phone_Number', $userData['phone_Number'], \PDO::PARAM_STR);
        $prevQuery->execute();
        $userData1 = $prevQuery->fetchAll(\PDO::FETCH_OBJ);
           
            if(count($userData1)==0){
                // Insert user data
               $oStmt = $this->oDb->prepare('INSERT INTO users(first_name,last_name,full_name,email,createdDate,modifiedDate,password,phone_Number) VALUES(:first_name,:last_name,:full_name,:email,:createdDate,:modifiedDate,:password,:phone_Number)');//, last_name, full_name,email,createdDate,modifiedDate) VALUES(:first_name, :last_name,:full_name,:email,:createdDate,:modifiedDate');
                $oStmt->execute($userData);
            }
             $oStmt = $this->oDb->prepare('SELECT * FROM users WHERE email = :email OR phone_Number = :phone_Number');
        $oStmt->bindParam(':email', $userData['email'], \PDO::PARAM_STR);
        $oStmt->bindParam(':phone_Number', $userData['phone_Number'], \PDO::PARAM_STR);
        $oStmt->execute();
        $userData = $oStmt->fetchAll(\PDO::FETCH_OBJ);
           
        }
        
        // Return user data
        return $userData;
    }
    
    public function getAllFields()
    {
        $oStmt = $this->oDb->query('SELECT * FROM Field');
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function getProfilePropertyDef()
    {
        $oStmt = $this->oDb->query('select * from profilepropertydefinition');
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    function addUserProfile($userData){
        
        if(!empty($userData)){
            // Check whether user data already exists in database

            $prevQuery = $this->oDb->prepare('SELECT * FROM UserProfile WHERE UserID = :userId AND PropertyDefinitionID = :propertyDefinitionId');
        $prevQuery->bindParam(':userId', $userData['UserID'], \PDO::PARAM_STR);
        $prevQuery->bindParam(':propertyDefinitionId', $userData['PropertyDefinitionID'], \PDO::PARAM_STR);
        $prevQuery->execute();
        $userData1 = $prevQuery->fetchAll(\PDO::FETCH_OBJ);
           
            if(count($userData1)==0){
                // Insert user data
               $oStmt = $this->oDb->prepare('INSERT INTO UserProfile(UserID,PropertyDefinitionID,PropertyValue,CreatedOnDate,LastModifiedOnDate) VALUES(:UserID,:PropertyDefinitionID,:PropertyValue,:CreatedOnDate,:LastModifiedOnDate)');
                $oStmt->execute($userData);
               $oStmt = $this->oDb->prepare('UPDATE Users SET isRegistrationComplete=1 WHERE userId=:userId');
               $oStmt->bindParam(':userId', $userData['UserID'], \PDO::PARAM_INT);
               $oStmt->execute();
               $_SESSION['getUserRegistrationComplete']=1;
                
            }
             $oStmt = $this->oDb->prepare('SELECT * FROM users WHERE email = :email OR phone_Number = :phone_Number');
        $oStmt->bindParam(':email', $_SESSION['email'], \PDO::PARAM_STR);
        $oStmt->bindParam(':phone_Number', $_SESSION['email'], \PDO::PARAM_STR);
        $oStmt->execute();
        $userData = $oStmt->fetchAll(\PDO::FETCH_OBJ);
           
        }
        
        // Return user data
        return $userData;
    }
    
}
