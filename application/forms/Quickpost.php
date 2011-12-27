<?php

class Application_Form_Quickpost extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an email element
        $this->addElement('text', 'email', array(
            'label'      => 'email:',
            'required'   => true,
			'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            )
            ));

        // Add the comment element
        $this->addElement('textarea', 'comment', array(
            'label'      => 'Post:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 140))
                )
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Post Something',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}
