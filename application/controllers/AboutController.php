<?php

class AboutController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

	$pageabout = new Application_Model_PageaboutMapper();	
	$this->view->entries = $pageabout->fetchAll();
    }

}


