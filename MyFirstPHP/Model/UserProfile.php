<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TestProject\Model;

/**
 * Description of UserProfile
 *
 * @author kalaiselvan
 */
class UserProfile {
    //put your code here
    protected $oDb;
    protected $userTbl ='users';
    public function __construct()
    {
        $this->oDb = new \TestProject\Engine\Db;
    }
    //put your code here
     public function getAllFields()
    {
        $oStmt = $this->oDb->query('SELECT * FROM Field');
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function getUserInfo($userId)
    {
        $oStmt = $this->oDb->prepare("
SELECT UserID,
         MAX(CASE WHEN PD.PropertyName = 'FullName' THEN PropertyValue ELSE '' END) AS FullName,
         MAX(CASE WHEN PD.PropertyName = 'PhoneNumber' THEN PropertyValue ELSE '' END) AS PhoneNumber,
         MAX(CASE WHEN PD.PropertyName = 'Email' THEN PropertyValue ELSE '' END) AS Email,
		MAX(CASE WHEN PD.PropertyName = 'Field' THEN PropertyValue ELSE NULL END) AS Field,
		 MAX(CASE WHEN PD.PropertyName = 'Degree' THEN PropertyValue ELSE NULL END) AS Degree,
		 MAX(CASE WHEN PD.PropertyName = 'Specialization' THEN PropertyValue ELSE NULL END) AS Specialization,
		 MAX(CASE WHEN PD.PropertyName = 'TopicGoodAt' THEN PropertyValue ELSE NULL END) AS TopicGoodAt,
		 MAX(CASE WHEN PD.PropertyName = 'TopicNeedHelp' THEN PropertyValue ELSE NULL END) AS TopicNeedHelp,
		MAX(CASE WHEN PD.PropertyName = 'Year' THEN PropertyValue ELSE NULL END) AS Year,
		MAX(CASE WHEN PD.PropertyName = 'Sem' THEN PropertyValue ELSE NULL END) AS Sem
    FROM userprofile AS UP 
INNER JOIN profilepropertydefinition as PD
on UP.PropertyDefinitionID=PD.PropertyDefinitionID
where UserID=:userId
GROUP BY UserID");
          $oStmt->bindValue(':userId', $userId, \PDO::PARAM_INT);
        $oStmt->execute();
        $oRow = $oStmt->fetch(\PDO::FETCH_OBJ);

        return @$oRow; // Use the PHP 5.5 password function
    }
    
    public function getMobileUserInfo($userId)
    {
        $oStmt = $this->oDb->prepare("
SELECT UserID,
         MAX(CASE WHEN PD.PropertyName = 'FullName' THEN PropertyValue ELSE '' END) AS FullName,
         MAX(CASE WHEN PD.PropertyName = 'PhoneNumber' THEN PropertyValue ELSE '' END) AS PhoneNumber,
         MAX(CASE WHEN PD.PropertyName = 'Email' THEN PropertyValue ELSE '' END) AS Email,
		MAX(CASE WHEN PD.PropertyName = 'Field' THEN PropertyValue ELSE NULL END) AS Field,
		 MAX(CASE WHEN PD.PropertyName = 'Degree' THEN PropertyValue ELSE NULL END) AS Degree,
		 MAX(CASE WHEN PD.PropertyName = 'Specialization' THEN PropertyValue ELSE NULL END) AS Specialization,
		 MAX(CASE WHEN PD.PropertyName = 'TopicGoodAt' THEN PropertyValue ELSE NULL END) AS TopicGoodAt,
		 MAX(CASE WHEN PD.PropertyName = 'TopicNeedHelp' THEN PropertyValue ELSE NULL END) AS TopicNeedHelp,
		MAX(CASE WHEN PD.PropertyName = 'Year' THEN PropertyValue ELSE NULL END) AS Year,
		MAX(CASE WHEN PD.PropertyName = 'Sem' THEN PropertyValue ELSE NULL END) AS Sem
    FROM userprofile AS UP 
INNER JOIN profilepropertydefinition as PD
on UP.PropertyDefinitionID=PD.PropertyDefinitionID
where UserID=:userId
GROUP BY UserID");
          $oStmt->bindValue(':userId', $userId, \PDO::PARAM_INT);
        $oStmt->execute();
        $oRow = $oStmt->fetchAll(\PDO::FETCH_OBJ);

        return $oRow; // Use the PHP 5.5 password function
    }
}
