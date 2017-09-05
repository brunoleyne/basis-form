<?php

namespace FormBootstrap\Form\View\Helper\Factory;

use FormBootstrap\Form\View\Helper\BootstrapFormElement;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory to inject the ModuleOptions hard dependency
 *
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class BootstrapFormElementFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->getServiceLocator()->get('FormBootstrap\Options\ModuleOptions');
        return new BootstrapFormElement($options);
    }
}
