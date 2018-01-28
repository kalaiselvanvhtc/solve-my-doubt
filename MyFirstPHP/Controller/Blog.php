<?php
/**
 * @author           Pierre-Henry Soria <phy@hizup.uk>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */

namespace TestProject\Controller;
require ROOT_PATH . '/vendor/autoload.php';

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;
use OpenTok\Session;
use OpenTok\Role;
class Blog
{
    const MAX_POSTS = 10;

    protected $oUtil, $oModel;
    private $_iId;
    private $_offSet;

    public function __construct()
    {
        // Enable PHP Session
        if (empty($_SESSION))
            @session_start();

        $this->oUtil = new \TestProject\Engine\Util;

        /** Get the Model class in all the controller class **/
        $this->oUtil->getModel('Blog');
        $this->oModel = new \TestProject\Model\Blog;
        $this->oUtil->oFields = $this->oModel->getAllFields();
        /** Get the Post ID in the constructor in order to avoid the duplication of the same code **/
        $this->_iId = (int) (!empty($_GET['id']) ? $_GET['id'] : 0);
        $this->_offSet = ((int) (!empty($_GET['offSet']) ? $_GET['offSet'] : 0))*self::MAX_POSTS;
    }


    /***** Front end *****/
    // Homepage
    public function index()
    {
        
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);
        $this->oUtil->oPosts = $this->oModel->get($this->_offSet, self::MAX_POSTS); // Get only the latest X posts
       if($this->_offSet>=0){
        $this->oUtil->getView('loadmoredata');
       }
       else
       {
        $this->oUtil->getView('index');
       }
    }
    

    public function post()
    {
        
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);
          if (!empty($_POST['submit_answer']))
        {
            if (isset($_POST['answerbody'])) // Allow a maximum of 50 characters
            {
                $isAllowConsult = true;
                if(isset($_POST['AllowConsultation']) && $_POST['AllowConsultation']==='allowconsult')
                    $isAllowConsult = true;
                else
                    $isAllowConsult=false;
                $aData = array('Answer' => $_POST['answerbody'],'IsConsultationRequired'=>$isAllowConsult, 'PostId' => $this->_iId, 'DateCreated' => date('Y-m-d H:i:s'),'DateUpdated' => date('Y-m-d H:i:s'),'AnswerXML' =>'','UserId'=>(int)$_SESSION['userId'],'AcceptedUserId'=>-1,'IsUserAcceptConsult'=>false);
                if ($this->oModel->addanswer($aData,(int)$_SESSION['userId']))
                {
                    //
                    
                }
                else
                    $this->oUtil->sErrMsg = 'Whoops! An error has occurred! Please try again later.';
            }
            else
            {
                $this->oUtil->sErrMsg = 'All fields are required and the title cannot exceed 50 characters.';
            }
           
        }
        $this->oUtil->oPost = $this->oModel->getById($this->_iId); // Get the data of the post
        $this->oUtil->oPosts = $this->oModel->getAnswers($this->_iId);
        $this->oUtil->getView('post');
    }
    
    public function answerpost()
    {
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);
        $this->oUtil->oPost = $this->oModel->getAnswerDetail($this->_iId,$_SESSION['userId']); // Get the data of the post
        $answers = $this->oModel->getAnswerDetailone($this->_iId,$_SESSION['userId']); // Get the data of the post
        $isUserAccept = true;
        $userId = 0;
        $doubterUserId = 0;
        $postId=0;
        $answerId=0;
        $sessionId='';
        $tokenId='';
         foreach ($answers as $value) {
         $isUserAccept = (int)$value->IsUserAcceptConsult>0;
         $userId = (int)$value->UserId;
           $doubterUserId = (int)$value->DoubterUserId;
           $postId=(int)$value->PostId;
        $answerId=(int)$value->AnswerId;
        $sessionId=$value->sessionId;
        $tokenId=$value->tokenId;
         }
        
          $_SESSION['apiKey'] = '46041242';
          
        if($sessionId=='' && $isUserAccept==true && ($userId==(int)$_SESSION['userId'] || $doubterUserId==(int)$_SESSION['userId']))
        {
            
            $sessionToken = $this->oModel->getSessoinToken($this->_iId,$_SESSION['userId']); // Get the data of the post
           $sessionId = '';
        $tokenId = '';
          
            foreach ($sessionToken as $value) {
         $sessionId = $value->sessionId;
         $tokenId = $value->tokenId;
         }
        
            if($sessionId!='')
            {  
            $_SESSION['sessionId'] = $sessionId;
            $_SESSION['token'] = $tokenId;
            }
            else
            {
                 
            $opentok = new OpenTok('46041242', 'e089584ff34595ea4885d6174280b44cb1ac7a94');
         
        // Create a session that attempts to use peer-to-peer streaming:
       // $sessionOptions = array(
    //'archiveMode' => ArchiveMode::ALWAYS,
   // 'mediaMode' => MediaMode::ROUTED
//);
$session = $opentok->createSession();


// Store this sessionId in the database for later use
$sessionId = $session->getSessionId();
$_SESSION['sessionId'] = $sessionId;
// Generate a Token by calling the method on the Session (returned from createSession)
$token = $session->generateToken(array('expireTime' => time()+(7 * 24 * 60 * 60)));
$_SESSION['token'] = $token;
$this->oModel->AddUpdateConsultation($postId,$answerId,$doubterUserId,$userId,$sessionId,$token); // Get the data of the post
}

          
        } 
        else
{
    $_SESSION['sessionId'] = $sessionId;
    $_SESSION['token'] = $tokenId;
}
$this->oUtil->getView('answerpost'); 
     
    }

    public function notFound()
    {
        $this->oUtil->getView('not_found');
    }


    /***** For Admin (Back end) *****/
    public function all()
    {
       
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);

     
 $this->oUtil->oPosts = $this->oModel->get(0, self::MAX_POSTS); // Get only the latest X posts
        $this->oUtil->getView('index');
    }

    public function acceptAnswer()
    {
     $this->oUtil->oPosts = array(200,"Answers",$this->oModel->acceptAnswer((int)$_GET['id'],(int)$_SESSION['userId']));
     $this->oUtil->getView('mobileAutoCompleteApi');
    }

    public function mobileacceptAnswer()
    {
     $this->oUtil->oPosts = array(200,"Answers",$this->oModel->acceptAnswer((int)$_GET['id'],(int)$_GET['userId']));
     $this->oUtil->getView('mobileAutoCompleteApi');
    }
    
    public function add()
    {
        try {
       
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);
 
        if (!empty($_POST['add_submit']))
        {
            if (isset($_POST['title'], $_POST['body'])) // Allow a maximum of 50 characters
            {
                $aData = array('title' => mb_strimwidth( $_POST['title'], 0, 40, '...'), 'body' => $_POST['body'], 'created_date' => date('Y-m-d H:i:s'),'createdbyuserid'=>(int)$_SESSION['userId']);

                if ($this->oModel->add($aData,(int)$_SESSION['userId'], $_POST['title']))
                {
                     header('Location: ' . ROOT_URL . '?p=blog&a=all');
                }
                else
                    $this->oUtil->sErrMsg = 'Whoops! An error has occurred! Please try again later.';
            }
            else
            {
                $this->oUtil->sErrMsg = 'Please enter Question and Topic';
            }
        }

        $this->oUtil->getView('add_post');
        }

catch (Exception $e) {
  //display custom message
   $this->oUtil->sErrMsg = $e->getMessage();
}
    }
    
     public function addanswer()
    {
        try {
       
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);
 
        if (!empty($_POST['submit_answer']))
        {
            if (isset($_POST['answerbody'])) // Allow a maximum of 50 characters
            {
                $isAllowConsult = true;
                if(isset($_POST['AllowConsultation']) && $_POST['AllowConsultation']==='allowconsult')
                    $isAllowConsult = true;
                else
                    $isAllowConsult=false;
                $aData = array('Answer' => $_POST['answerbody'],'IsConsultationRequired'=>$isAllowConsult, 'PostId' => $this->_iId, 'DateCreated' => date('Y-m-d H:i:s'),'DateUpdated' => date('Y-m-d H:i:s'),'AnswerXML' =>'','UserId'=>(int)$_SESSION['userId'],'AcceptedUserId'=>-1,'IsUserAcceptConsult'=>false);

                if ($this->oModel->addanswer($aData,(int)$_SESSION['userId']))
                {
                    //
                    
                }
                else
                    $this->oUtil->sErrMsg = 'Whoops! An error has occurred! Please try again later.';
            }
            else
            {
                $this->oUtil->sErrMsg = 'All fields are required and the title cannot exceed 50 characters.';
            }
           
        }

        }

catch (Exception $e) {
  //display custom message
   $this->oUtil->sErrMsg = $e->getMessage();
}
    }

    public function edit()
    {
        
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);

        if (!empty($_POST['edit_submit']))
        {
            if (isset($_POST['title'], $_POST['body']))
            {
                $aData = array('post_id' => $this->_iId, 'title' => $_POST['title'], 'body' => $_POST['body']);

                if ($this->oModel->update($aData))
                     header('Location: ' . ROOT_URL . '?p=blog&a=all');
                else
                    $this->oUtil->sErrMsg = 'Whoops! An error has occurred! Please try again later';
            }
            else
            {
                $this->oUtil->sErrMsg = 'All fields are required.';
            }
        }

        /* Get the data of the post */
        $this->oUtil->oPost = $this->oModel->getById($this->_iId);

        $this->oUtil->getView('edit_post');
    }

    public function delete()
    {
      
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);

        if (!empty($_POST['delete']) && $this->oModel->delete($this->_iId))
            header('Location: ' . ROOT_URL);
        else
            exit('Whoops! Post cannot be deleted.');
    }
    
    public function autoComplete()
    {
        switch ($_GET['type'])
        {
            case 'degree':
                 $this->oUtil->objAuto = $this->oModel->getDegree($_GET['fieldId']);
                $this->oUtil->getView('autocompleteApi');
               break;
           case 'specialization':
                   $this->oUtil->objAuto = $this->oModel->specialization($_GET['fieldId'],$_GET['degreeId'],$_GET['name_startsWith']);
                $this->oUtil->getView('autocompleteApi');
               break;
           case 'topics':
                   $this->oUtil->objAuto = $this->oModel->topic($_GET['fieldId'],$_GET['degreeId'],$_GET['name_startsWith'],$_GET['speciazation']);
                $this->oUtil->getView('autocompleteApi');
               break;
           case 'userTopics':
                   $this->oUtil->objAuto = $this->oModel->userTopics((int)$_SESSION['userId']);
                $this->oUtil->getView('autocompleteApi');
               break;
            default:
                $this->oUtil->objAuto = $this->oModel->getAllFields();
                $this->oUtil->getView('autocompleteApi');
                break;
        } 
    }
    
    public function mobileautoComplete()
    {
        switch ($_GET['type'])
        {
            case 'degree':
                $this->oUtil->oPosts = array(200,"User Information",$this->oModel->getDegree($_GET['fieldId']));
                $this->oUtil->getView('mobileAutoCompleteApi');
               break;
           case 'specialization':
                 $this->oUtil->oPosts = array(200,"User Information",$this->oModel->specialization($_GET['fieldId'],$_GET['degreeId'],$_GET['name_startsWith']));
                $this->oUtil->getView('mobileAutoCompleteApi');
               break;
           case 'topics':
               $this->oUtil->oPosts = array(200,"User Information",$this->oModel->topic($_GET['fieldId'],$_GET['degreeId'],$_GET['name_startsWith'],$_GET['speciazation']));
                $this->oUtil->getView('mobileAutoCompleteApi');
               break;
             case 'userTopics':
               $this->oUtil->oPosts = array(200,"User Topics",$this->oModel->userTopics((int)$_GET['userId']));
                $this->oUtil->getView('mobileAutoCompleteApi');
               break;
            default:
                
                $this->oUtil->oPosts = array(200,"User Information",$this->oModel->mobilegetAllFields());
                $this->oUtil->getView('mobileAutoCompleteApi');
                break;
        } 
    }
    
    public function mobileIndex()
    {
        $this->oUtil->oPosts = array(200,"List",$this->oModel->get($this->_offSet, self::MAX_POSTS));
        $this->oUtil->getView('mobileAutoCompleteApi');
    }
    
    public function mobilepost()
    {
     $this->oUtil->oPosts = array(200,"Detail",$this->oModel->getById($_GET['id']));
     $this->oUtil->getView('mobileAutoCompleteApi');
    }
    
    public function mobileanswers()
    {
     $this->oUtil->oPosts = array(200,"Answers",$this->oModel->getAnswers($_GET['id']));
     $this->oUtil->getView('mobileAutoCompleteApi');
    }
    
     public function mobileanswerpost()
    {
     $this->oUtil->oPosts = array(200,"Answers",$this->oModel->getAnswerDetail($_GET['id'],$_GET['userId']));
     $this->oUtil->getView('mobileAutoCompleteApi');
    }
    
    public function mobilegetsessiontoken()
    {
         $sessionToken = $this->oModel->getSessoinToken($_GET['id'],$_GET['userId']); // Get the data of the post
           $sessionId = '';
        $tokenId = '';
          
            foreach ($sessionToken as $value) {
         $sessionId = $value->sessionId;
         $tokenId = $value->tokenId;
         }
        
            if($sessionId=='')
            {
                 
            $opentok = new OpenTok('46041242', 'e089584ff34595ea4885d6174280b44cb1ac7a94');
         
        // Create a session that attempts to use peer-to-peer streaming:
       // $sessionOptions = array(
    //'archiveMode' => ArchiveMode::ALWAYS,
   // 'mediaMode' => MediaMode::ROUTED
//);
$session = $opentok->createSession();


// Store this sessionId in the database for later use
$sessionId = $session->getSessionId();
// Generate a Token by calling the method on the Session (returned from createSession)
$token = $session->generateToken(array('expireTime' => time()+(7 * 24 * 60 * 60)));
$this->oModel->AddUpdateConsultation($postId,$answerId,$doubterUserId,$userId,$sessionId,$token); // Get the data of the post
}
          
        
     $this->oUtil->oPosts = array(200,"Answers",$this->oModel->getAnswerDetail($_GET['id'],$_GET['userId']));
     $this->oUtil->getView('mobileAutoCompleteApi');
    }
    
    
     public function mobileadd()
    {
            if (isset($_GET['title'], $_GET['body']) && mb_strlen($_GET['title']) <= 50) // Allow a maximum of 50 characters
            {
                $aData = array('title' => $_GET['title'], 'body' => $_GET['body'], 'created_date' => date('Y-m-d H:i:s'),'createdbyuserid'=>(int)$_GET['userId']);

                if ($this->oModel->add($aData,(int)$_GET['userId']))
                {
                    $this->oUtil->oPosts = array(200,"User Information","Inserted successfully");
                    $this->oUtil->getView('mobileAutoCompleteApi');
                }
                else{
                    $this->oUtil->oPosts = array(200,"Error","Error in insert");
                $this->oUtil->getView('mobileAutoCompleteApi');
                }
            }
            else
            {
               $this->oUtil->oPosts = array(200,"Error","Error in validation");
                $this->oUtil->getView('mobileAutoCompleteApi');
            }       
    }
    
    
    
      public function mobileaddanswer()
    {
        try {
       
                   if (isset($_GET['answerbody'])) // Allow a maximum of 50 characters
            {
                $isAllowConsult = true;
                if(isset($_GET['AllowConsultation']) && $_GET['AllowConsultation']==='allowconsult')
                    $isAllowConsult = true;
                else
                    $isAllowConsult=false;
                $aData = array('Answer' => $_GET['answerbody'],'IsConsultationRequired'=>$isAllowConsult, 'PostId' => $_GET['postId'], 'DateCreated' => date('Y-m-d H:i:s'),'DateUpdated' => date('Y-m-d H:i:s'),'AnswerXML' =>'','UserId'=>$_GET['userId'],'AcceptedUserId'=>-1,'IsUserAcceptConsult'=>false);

                if ($this->oModel->addanswer($aData,(int)$_GET['userId']))
                {
                    $this->oUtil->oPosts = array(200,"Success","Added answer");
                $this->oUtil->getView('mobileAutoCompleteApi');
                    
                }
                else
                    {
                    $this->oUtil->oPosts = array(200,"Error","Error in insert");
                $this->oUtil->getView('mobileAutoCompleteApi');
                }
            }
            else
            {
               $this->oUtil->oPosts = array(200,"Error","Error in validation");
                $this->oUtil->getView('mobileAutoCompleteApi');
            }   
           
        }

        

catch (Exception $e) {
  //display custom message
$this->oUtil->oPosts = array(500,"Error",$e);
                $this->oUtil->getView('mobileAutoCompleteApi');
                
}
    }
    
    protected function isLogged()
    {
        return !empty($_SESSION['is_logged']);
    }
    
    
}
