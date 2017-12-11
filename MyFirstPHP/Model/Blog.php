<?php
/**
 * @author           Pierre-Henry Soria <phy@hizup.uk>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */

namespace TestProject\Model;

class Blog
{
    
    protected $oDb;

    public function __construct()
    {
        $this->oDb = new \TestProject\Engine\Db;
    }

    public function get($iOffset, $iLimit)
    {
        $oStmt = $this->oDb->prepare('SELECT * FROM Posts ORDER BY createdDate DESC LIMIT :offset, :limit');
        $oStmt->bindParam(':offset', $iOffset, \PDO::PARAM_INT);
        $oStmt->bindParam(':limit', $iLimit, \PDO::PARAM_INT);
        $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAll()
    {
        $oStmt = $this->oDb->query('SELECT * FROM Posts ORDER BY createdDate DESC');
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAllFields()
    {
        $oStmt = $this->oDb->query('SELECT * FROM Field');
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function mobilegetAllFields()
    {
        $oStmt = $this->oDb->query('SELECT DegreeName FROM Field');
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function getDegree($fieldId)
    {
        $oStmt = $this->oDb->prepare('SELECT DegreeId as Id, DegreeName as Name FROM Degree WHERE FieldId = :fieldId');
         $oStmt->bindParam(':fieldId', $fieldId, \PDO::PARAM_INT);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function specialization($fieldId,$degreeId,$spec)
    {
         $spec = "%".$spec."%";
        $oStmt = $this->oDb->prepare('SELECT SpecializationId as Id, SpecializationName as Name FROM Specialization WHERE FieldId = :fieldId AND DegreeId = :degreeId AND SpecializationName LIKE :specializationName');
         $oStmt->bindParam(':fieldId', $fieldId, \PDO::PARAM_INT);
         $oStmt->bindParam(':degreeId', $degreeId, \PDO::PARAM_INT);
         $oStmt->bindParam(':specializationName', $spec, \PDO::PARAM_STR);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function topic($fieldId,$degreeId,$topic)
    {
         $topic = "%".$topic."%";
         $oStmt = $this->oDb->prepare('SELECT TopicId as Id, TopicName as Name FROM Topics WHERE FieldId = :fieldId AND DegreeId = :degreeId AND TopicName LIKE :topicName');
         $oStmt->bindParam(':fieldId', $fieldId, \PDO::PARAM_INT);
         $oStmt->bindParam(':degreeId', $degreeId, \PDO::PARAM_INT);
         $oStmt->bindParam(':topicName', $topic, \PDO::PARAM_STR);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function mobilegetDegree($fieldName)
    {
        $oStmt = $this->oDb->prepare('SELECT DegreeName as Name FROM Degree WHERE FieldName = :fieldName');
         $oStmt->bindParam(':fieldName', $fieldName, \PDO::PARAM_STR);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function mobilespecialization($fieldName,$degreeName,$spec)
    {
         $spec = "%".$spec."%";
        $oStmt = $this->oDb->prepare('SELECT SpecializationName as Name FROM Specialization WHERE FieldName = :fieldName AND DegreeName = :degreeName AND SpecializationName LIKE :specializationName');
         $oStmt->bindParam(':fieldName', $fieldName, \PDO::PARAM_STR);
         $oStmt->bindParam(':degreeName', $degreeName, \PDO::PARAM_STR);
         $oStmt->bindParam(':specializationName', $spec, \PDO::PARAM_STR);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function mobiletopic($fieldName,$degreeName,$topic)
    {
         $topic = "%".$topic."%";
         $oStmt = $this->oDb->prepare('SELECT TopicName as Name FROM Topics WHERE FieldName = :fieldName AND DegreeName = :degreeName AND TopicName LIKE :topicName');
         $oStmt->bindParam(':fieldName', $fieldName, \PDO::PARAM_STR);
         $oStmt->bindParam(':degreeName', $degreeName, \PDO::PARAM_STR);
         $oStmt->bindParam(':topicName', $topic, \PDO::PARAM_STR);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    
    public function add(array $aData)
    {
        $oStmt = $this->oDb->prepare('INSERT INTO Posts (title, body, createdDate) VALUES(:title, :body, :created_date)');
        return $oStmt->execute($aData);
    }

    public function getById($iId)
    {
        $oStmt = $this->oDb->prepare('SELECT * FROM Posts WHERE id = :postId LIMIT 1');
        $oStmt->bindParam(':postId', $iId, \PDO::PARAM_INT);
        $oStmt->execute();
        return $oStmt->fetch(\PDO::FETCH_OBJ);
    }

    public function update(array $aData)
    {
        $oStmt = $this->oDb->prepare('UPDATE Posts SET title = :title, body = :body WHERE id = :postId LIMIT 1');
        $oStmt->bindValue(':postId', $aData['post_id'], \PDO::PARAM_INT);
        $oStmt->bindValue(':title', $aData['title']);
        $oStmt->bindValue(':body', $aData['body']);
        return $oStmt->execute();
    }

    public function delete($iId)
    {
        $oStmt = $this->oDb->prepare('DELETE FROM Posts WHERE id = :postId LIMIT 1');
        $oStmt->bindParam(':postId', $iId, \PDO::PARAM_INT);
        return $oStmt->execute();
    }
}
