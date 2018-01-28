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
        $sql = 'CALL GetDataOnScroll(:pageIndex,:pageSize)';
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
        // pass value to the command
        $oStmt->bindParam(':pageIndex', $iOffset, \PDO::PARAM_INT);
       $oStmt->bindParam(':pageSize', $iLimit, \PDO::PARAM_INT);
       $oStmt->execute();
        // execute the stored procedure
      return  $oStmt->fetchAll(\PDO::FETCH_OBJ);
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
        $oStmt = $this->oDb->query('SELECT FieldId as Id, FieldName as Name FROM Field');
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
    
     public function topic($fieldId,$degreeId,$topic,$specId)
    {
         $topic = "%".$topic."%";
         $oStmt = $this->oDb->prepare('SELECT TopicId as Id, TopicName as Name FROM Topics WHERE find_in_set(SpecializationId, :specializationId) AND FieldId = :fieldId AND DegreeId = :degreeId AND TopicName LIKE :topicName');
         $oStmt->bindParam(':fieldId', $fieldId, \PDO::PARAM_INT);
         $oStmt->bindParam(':degreeId', $degreeId, \PDO::PARAM_INT);
         $oStmt->bindParam(':topicName', $topic, \PDO::PARAM_STR);
         $oStmt->bindParam(':specializationId', $specId, \PDO::PARAM_STR);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function mobilegetDegree($fieldName)
    {
        $oStmt = $this->oDb->prepare('SELECT DegreeId as Id, DegreeName as Name FROM Degree WHERE FieldName = :fieldName');
         $oStmt->bindParam(':fieldName', $fieldName, \PDO::PARAM_STR);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function mobilespecialization($fieldName,$degreeName,$spec)
    {
         $spec = "%".$spec."%";
        $oStmt = $this->oDb->prepare('SELECT SpecializationId as Id, SpecializationName as Name FROM Specialization WHERE FieldName = :fieldName AND DegreeName = :degreeName AND SpecializationName LIKE :specializationName');
         $oStmt->bindParam(':fieldName', $fieldName, \PDO::PARAM_STR);
         $oStmt->bindParam(':degreeName', $degreeName, \PDO::PARAM_STR);
         $oStmt->bindParam(':specializationName', $spec, \PDO::PARAM_STR);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
     public function mobiletopic($fieldName,$degreeName,$topic)
    {
         $topic = "%".$topic."%";
         $oStmt = $this->oDb->prepare('SELECT TopicId as Id, TopicName as Name FROM Topics WHERE FieldName = :fieldName AND DegreeName = :degreeName AND TopicName LIKE :topicName');
         $oStmt->bindParam(':fieldName', $fieldName, \PDO::PARAM_STR);
         $oStmt->bindParam(':degreeName', $degreeName, \PDO::PARAM_STR);
         $oStmt->bindParam(':topicName', $topic, \PDO::PARAM_STR);
         $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    
    public function add(array $aData, $currentUserId,  $topics)
    {
        $oStmt = $this->oDb->prepare('INSERT INTO Posts (title, body, createdDate,createdbyuserid) VALUES(:title, :body, :created_date,:createdbyuserid)');
        $oStmt->execute($aData);
        $currentPostId = $this->oDb->lastInsertId();
        $sql = 'CALL AddTags(:currentUserId,:currentPostId)';
 
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
 
        // pass value to the command
        $oStmt->bindParam(':currentUserId', $currentUserId, \PDO::PARAM_INT);
       $oStmt->bindParam(':currentPostId', $currentPostId, \PDO::PARAM_INT);
       
        // execute the stored procedure
        $oStmt->execute();
        
 $sql = 'CALL AddTopicsTag(:currentUserId,:currentPostId,:topics)';
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
 
        // pass value to the command
        $oStmt->bindParam(':currentUserId', $currentUserId, \PDO::PARAM_INT);
       $oStmt->bindParam(':currentPostId', $currentPostId, \PDO::PARAM_INT);
       $oStmt->bindParam(':topics', $topics, \PDO::PARAM_STR);
      
        return $oStmt->execute();
    }
    
    
    public function addanswer(array $aData, $currentUserId)
    {
        $oStmt = $this->oDb->prepare('INSERT INTO answers (Answer, UserId, DateCreated,DateUpdated,AnswerXML,PostId,IsConsultationRequired,AcceptedUserId,IsUserAcceptConsult) VALUES(:Answer, :UserId, :DateCreated,:DateUpdated,:AnswerXML,:PostId,:IsConsultationRequired,:AcceptedUserId,:IsUserAcceptConsult)');
        return $oStmt->execute($aData);
        
    }
    
    public function userTopics($currentUserId)
    {
        $sql = 'CALL GetUserTopics(:currentUserId)';
 
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
 
        // pass value to the command
        $oStmt->bindParam(':currentUserId', $currentUserId, \PDO::PARAM_INT);
         
        // execute the stored procedure
        $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function getAnswers($iId)
    {
         $sql = 'CALL GetAnswersById(:Id)';
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
        // pass value to the command
        $oStmt->bindParam(':Id', $iId, \PDO::PARAM_INT);
       $oStmt->execute();
        // execute the stored procedure
      return  $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    
    
    
    public function getAnswerDetail($iId,$currentUserId)
    {
         $sql = 'CALL GetAnswerDetail(:Id,:currentUserId)';
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
        // pass value to the command
        $oStmt->bindParam(':Id', $iId, \PDO::PARAM_INT);
        $oStmt->bindParam(':currentUserId', $currentUserId, \PDO::PARAM_INT);
       $oStmt->execute();
        // execute the stored procedure
      return  $oStmt->fetch(\PDO::FETCH_OBJ);
    }
    
    public function getAnswerDetailone($iId,$currentUserId)
    {
         $sql = 'CALL GetAnswerDetail(:Id,:currentUserId)';
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
        // pass value to the command
        $oStmt->bindParam(':Id', $iId, \PDO::PARAM_INT);
        $oStmt->bindParam(':currentUserId', $currentUserId, \PDO::PARAM_INT);
       $oStmt->execute();
        // execute the stored procedure
      return  $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    
    public function getSessoinToken($iId,$currentUserId)
    {
         $sql = 'CALL getSessoinToken(:Id,:currentUserId)';
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
        // pass value to the command
        $oStmt->bindParam(':Id', $iId, \PDO::PARAM_INT);
        $oStmt->bindParam(':currentUserId', $currentUserId, \PDO::PARAM_INT);
        $oStmt->execute();
        // execute the stored procedure
      return  $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function acceptAnswer($iId,$userId)
    {
         $sql = 'CALL AcceptAnswer(:ansId,:currentUserId)';
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
        // pass value to the command
        $oStmt->bindParam(':ansId', $iId, \PDO::PARAM_INT);
        $oStmt->bindParam(':currentUserId', $userId, \PDO::PARAM_INT);

        $oStmt->execute();
     return  $oStmt->fetch(\PDO::FETCH_OBJ);
    }
    
    public function AddUpdateConsultation($_postId,$_answerId,$_postAuthorId,$_answerAuthorId,$_sessionId,$_tokenId)
    {
         $sql = 'CALL AddConsultation(:_postId,:_answerId,:_postAuthorId,:_answerAuthorId,:_sessionId,:_tokenId)';
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
        // pass value to the command
        $oStmt->bindParam(':_postId', $_postId, \PDO::PARAM_INT);
        $oStmt->bindParam(':_answerId', $_answerId, \PDO::PARAM_INT);
        $oStmt->bindParam(':_postAuthorId', $_postAuthorId, \PDO::PARAM_INT);
        $oStmt->bindParam(':_answerAuthorId', $_answerAuthorId, \PDO::PARAM_INT);
        $oStmt->bindParam(':_sessionId', $_sessionId, \PDO::PARAM_STR);
        $oStmt->bindParam(':_tokenId', $_tokenId, \PDO::PARAM_STR);
       return $oStmt->execute();
     
    }
    
    public function getById($iId)
    {
         $sql = 'CALL GetQuestionById(:questionId)';
        // prepare for execution of the stored procedure
        $oStmt = $this->oDb->prepare($sql);
        // pass value to the command
        $oStmt->bindParam(':questionId', $iId, \PDO::PARAM_INT);
       $oStmt->execute();
        // execute the stored procedure
      return  $oStmt->fetch(\PDO::FETCH_OBJ);
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
