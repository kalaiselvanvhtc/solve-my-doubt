<?php
/**
 * @author           Pierre-Henry Soria <phy@hizup.uk>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */

namespace TestProject\Controller;

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
        $this->oUtil->oPost = $this->oModel->getById($this->_iId); // Get the data of the post

        $this->oUtil->getView('post');
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


    public function add()
    {
        try {
       
         if(!$this->isLogged())
              header('Location: ' . ROOT_URL);
 
        if (!empty($_POST['add_submit']))
        {
            if (isset($_POST['title'], $_POST['body']) && mb_strlen($_POST['title']) <= 50) // Allow a maximum of 50 characters
            {
                $aData = array('title' => $_POST['title'], 'body' => $_POST['body'], 'created_date' => date('Y-m-d H:i:s'),'createdbyuserid'=>(int)$_SESSION['userId']);

                if ($this->oModel->add($aData,(int)$_SESSION['userId']))
                {
                     header('Location: ' . ROOT_URL . '?p=blog&a=all');
                }
                else
                    $this->oUtil->sErrMsg = 'Whoops! An error has occurred! Please try again later.';
            }
            else
            {
                $this->oUtil->sErrMsg = 'All fields are required and the title cannot exceed 50 characters.';
            }
        }

        $this->oUtil->getView('add_post');
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
            default:
                
                $this->oUtil->oPosts = array(200,"User Information",$this->oModel->mobilegetAllFields());
                $this->oUtil->getView('mobileAutoCompleteApi');
                break;
        } 
    }
    
    public function mobileIndex()
    {
        $this->oUtil->oPosts = array(200,"Home",$this->oModel->get($this->_offSet, self::MAX_POSTS));
        $this->oUtil->getView('mobileAutoCompleteApi');
    }
    

    
    protected function isLogged()
    {
        return !empty($_SESSION['is_logged']);
    }
}
