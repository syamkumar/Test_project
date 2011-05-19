<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CheckController.php';

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
       // $this->_helper->redirector('user/index');
        $this->_helper->redirector('add');
    }
    
   public function getAction()
    {
        // action body
       $albumTable= new Application_Model_Albums();

       $this->view->albumTable=$albumTable->getAlbum();


    }
    public function addAction()
    {
        // action body
        $addTable= new Application_Model_Albums();
        
        $this->view->albumTable=$addTable->getAlbum();
        $request = $this->getRequest();
        $a_name=$request->getPost('a_name');
        $a_det=$request->getPost('a_det');
       
       // $this->view->albumTable=$addTable->getAlbum();

       $FlashMessenger = $this->_helper->getHelper('FlashMessenger');
       $this->view->addTable  = array_pop($FlashMessenger->getMessages());

if($this->_request->isPost())
{

        if($a_name=='' ||  $a_det=='')
        {
          $this->view->addTable="Please enter data..";
          return;

        }

     else{
      $result=$addTable->addAlbum($a_name,$a_det);
        if($result<>0)
        {
           $this->view->addTable="done.." ;
        }
        else
        {
             $this->view->addTable="not done.." ;
        }
        
      //  $this->view->addTable=$this->_flash;
         $this->view->albumTable=$addTable->getAlbum();
     }
  }
  }
//public function detAction()
//    {
//   // echo "iutuiug--";exit;
//        // action body
//       $albumTable= new Application_Model_Albums();
//        $request = $this->getRequest();
//        $id=$request->getParam('id');
//       $this->view->albumTable=$albumTable->detAlbum($id);
//
//
//    }
    //for editting details
    public function editAction()
    {
        // action body
        $editTable= new Application_Model_Albums();
        ////////////////////////////////////////////////
        $request = $this->getRequest();
        $id=$request->getParam('id');
        //$flag=$request->getParam('flag');
        //echo $flag;exit;
        $this->view->albumTable=$editTable->detAlbum($id);
        ////////////////////////////////////////////////
//        if($flag==0)
//        {
//            deleteAction();
//        }
        $request = $this->getRequest();
        $a_name=$request->getParam('a_name');
        $a_det=$request->getParam('a_det');

        if($a_name=='' ||  $a_det=='')
        {
          $this->view->addTable="Please enter data..";
          return;

        }

       $result=$editTable->editAlbum($a_name,$a_det,$id);
       $this->_helper->FlashMessenger->addMessage('Edited successfully....');
       $this->_helper->redirector("add");

       
    }

    public function deleteAction()
    {
       //$this->_helper->viewRenderer->setNoRender();
        $deleteTable=new Application_Model_Albums();
        $request = $this->getRequest();
        $id=$request->getParam('id');
        $delresult=$deleteTable->deleteAlbum($id);
        $this->_helper->FlashMessenger->addMessage('deleted successfully....');
        $this->_helper->redirector("add");
     }

     public function commondataAction()
     {
        // echo "haiiiii......";exit;
         $commonData=new Application_Model_Albums();
         $this->view->commonData= $commonData->getCommondata();
     }


}

