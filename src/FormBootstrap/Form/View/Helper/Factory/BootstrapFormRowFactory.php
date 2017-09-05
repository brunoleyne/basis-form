<?php

namespace FormBootstrap\Form\View\Helper\Factory;

use FormBootstrap\Form\View\Helper\BootstrapFormRow;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * Factory to inject the ModuleOptions hard dependency
 *
 * @author Felippe Ladeira <ffgalvao@gmail.com>
 * @license MIT
 */
class BootstrapFormRowFactory implements FactoryInterface
{
    private $formRow;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        if (is_null($this->formRow)) {
            $viewhelp = $serviceLocator->getServiceLocator()->get('ViewHelperManager');
            $form = $viewhelp->get('form');
            $this->formRow = new BootstrapFormRow($form);
        }

        return $this->formRow;
    }
}
