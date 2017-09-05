<?php
namespace FormBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormElementErrors;

class BootstrapFormElementErrors extends FormElementErrors
{
    protected $attributes = array(
        'class' => 'help-block'
    );
}
