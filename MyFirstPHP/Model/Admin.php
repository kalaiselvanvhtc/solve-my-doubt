<?php
/**
 * @author           Pierre-Henry Soria <phy@hizup.uk>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */

namespace TestProject\Model;

class Admin extends Blog
{
    public function login($sEmail) 
    {
        
        $oStmt = $this->oDb->prepare('SELECT email, password, userId,isRegistrationComplete FROM users WHERE email = :email OR phone_Number = :email LIMIT 1');
        $oStmt->bindValue(':email', $sEmail, \PDO::PARAM_STR);
        $oStmt->execute();
        $oRow = $oStmt->fetch(\PDO::FETCH_OBJ);

        return @$oRow; // Use the PHP 5.5 password function
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
             $oStmt = $this->oDb->prepare('SELECT userId,first_name,last_name,full_name,email,createdDate,modifiedDate,password,phone_Number,CAST(isRegistrationComplete AS unsigned integer) AS isRegistrationComplete FROM users WHERE email = :email OR phone_Number = :email');
        $oStmt->bindParam(':email', $userData['email'], \PDO::PARAM_STR);
        $oStmt->execute();
        $userData = $oStmt->fetchAll(\PDO::FETCH_OBJ);
        }
        
        // Return user data
        return $userData;
    }
}
