<?php

class ErrorController extends Zend_Controller_Action
{

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
       // echo "<pre>";
       // print_r($errors->exception->getMessage());exit;

       // echo $errors->exception;exit;
        
    	switch ($errors->type) {
    		case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
            	$this->getResponse()->setHttpResponseCode(404);
            	$this->view->errMessage = "404 - Page not found.";
            	break;

            default:
            	$this->getResponse()->setHttpResponseCode(500);
            	$this->view->errMessage = "500 - Internal server error.";
            	break;
        }
    }


}

