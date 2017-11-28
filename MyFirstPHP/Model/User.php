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
            $prevQuery = "SELECT * FROM users WHERE email = '".$userData['email']."'OR phone_Number = '".$userData['phone_Number']."'";
            $prevResult = $this->oDb->query($prevQuery);
           // $userData1 = $prevResult->fetch_assoc();
            

            if($prevResult->num_rows > 0){
                // Update user data if already exists
                $query = "UPDATE ".$this->userTbl." SET first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', modifiedDate = '".date('Y-m-d H:i:s')."' WHERE  email = '".$userData['email']."'OR phone_Number = '".$userData['phone_Number']."'";
                $this->oDb->query($query);
            }else{
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
