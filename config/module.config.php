<?php

return array(
    'formbootstrap' => array(
        'ignoredViewHelpers' => array(
            'file',
            'checkbox',
            'radio',
            'submit',
            'multi_checkbox',
            'static',
            'button',
            'reset'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'FormBootstrap\Options\ModuleOptions' => 'FormBootstrap\Options\Factory\ModuleOptionsFactory'
        )
    ),
    'view_helpers' => array(
        'invokables' => array(
            //Alert
            'alert' => 'FormBootstrap\View\Helper\BootstrapAlert',
            //Badge
            'badge' => 'FormBootstrap\View\Helper\BootstrapBadge',
            //Button group
            'buttonGroup' => 'FormBootstrap\View\Helper\BootstrapButtonGroup',
            //DropDown
            'dropDown' => 'FormBootstrap\View\Helper\BootstrapDropDown',
            //Form
//            'form'              => 'BootstrapFormFactories',
//            'formRow'           => 'BootstrapFormRowFactories',
            'formButton' => 'FormBootstrap\Form\View\Helper\BootstrapFormButton',
            'formSubmit' => 'FormBootstrap\Form\View\Helper\BootstrapFormButton',
            'formCheckbox' => 'FormBootstrap\Form\View\Helper\BootstrapFormCheckbox',
            'formCollection' => 'FormBootstrap\Form\View\Helper\BootstrapFormCollection',
            'formElementErrors' => 'FormBootstrap\Form\View\Helper\BootstrapFormElementErrors',
            'formMultiCheckbox' => 'FormBootstrap\Form\View\Helper\BootstrapFormMultiCheckbox',
            'formRadio' => 'FormBootstrap\Form\View\Helper\BootstrapFormRadio',
            'formStatic' => 'FormBootstrap\Form\View\Helper\BootstrapFormStatic',
            //Form Errors
            'formErrors' => 'FormBootstrap\Form\View\Helper\BootstrapFormErrors',
            //Glyphicon
            'glyphicon' => 'FormBootstrap\View\Helper\BootstrapGlyphicon',
            //FontAwesome
            'fontAwesome' => 'FormBootstrap\View\Helper\BootstrapFontAwesome',
            //Label
            'label' => 'FormBootstrap\View\Helper\BootstrapLabel'
        ),
        'factories' => array(
            'form' => 'FormBootstrap\Form\View\Helper\Factory\BootstrapFormFactory',
            'formRow' => 'FormBootstrap\Form\View\Helper\Factory\BootstrapFormRowFactory',
            'formRowCustom' => 'FormBootstrap\Form\View\Helper\Factory\BootstrapFormRowCustomFactory',
            'formElement' => 'FormBootstrap\Form\View\Helper\Factory\BootstrapFormElementFactory',
        )
    ),
);
