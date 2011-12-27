<?php

class Application_Form_Pageabout extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add the title element
        $this->addElement('text', 'pagetitle', array(
            'label'      => 'Page title:',
            'required'   => false,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 140))
                )
        ));

        // Add the content element
        $this->addElement('textarea', 'content', array(
            'label'      => 'Page content:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array())
                )
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Submit',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}
