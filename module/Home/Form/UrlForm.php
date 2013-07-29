<?php
namespace Home\Form;

use Zend\Form\Form;

class UrlForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('url');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'url',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Url ',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

    }
}
