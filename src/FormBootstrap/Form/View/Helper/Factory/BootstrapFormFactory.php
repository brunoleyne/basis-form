<?php

namespace FormBootstrap\Form\View\Helper\Factory;

use FormBootstrap\Form\View\Helper\BootstrapForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * Factory to inject the ModuleOptions hard dependency
 *
 * @author Felippe Ladeira <ffgalvao@gmail.com>
 * @license MIT
 */
class BootstrapFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->getServiceLocator()->get('FormBootstrap\Options\ModuleOptions');
        return new BootstrapForm($options);
    }
}
