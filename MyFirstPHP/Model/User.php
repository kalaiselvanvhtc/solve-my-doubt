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
}
