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


    public function editAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Pageabout();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Pageabout($form->getValues());
                $mapper  = new Application_Model_PageaboutMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }


}


