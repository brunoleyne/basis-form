<?php

namespace FormBootstrap\Form\View\Helper\Factory;

use FormBootstrap\Form\View\Helper\BootstrapFormRowCustom;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * Factory to inject the ModuleOptions hard dependency
 *
 * @author Felippe Ladeira <ffgalvao@gmail.com>
 * @license MIT
 */
class BootstrapFormRowCustomFactory implements FactoryInterface
{
    private $formRow;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        if (is_null($this->formRow)) {
            $viewhelp = $serviceLocator->getServiceLocator()->get('ViewHelperManager');
            $form = $viewhelp->get('form');
            $this->formRow = new BootstrapFormRowCustom($form);
        }

        return $this->formRow;
    }
}
