<?php

namespace FormBootstrap\Options\Factory;

use FormBootstrap\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $options = $config['formbootstrap'];
        return new ModuleOptions($options);
    }
}
