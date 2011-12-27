<?php

class QuickpostController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function postAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Quickpost();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Quickpost($form->getValues());
                $mapper  = new Application_Model_QuickpostMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }


}

