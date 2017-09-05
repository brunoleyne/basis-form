<?php
namespace FormBootstrap;

class Module implements
    \Zend\ModuleManager\Feature\ConfigProviderInterface,
    \Zend\ModuleManager\Feature\AutoloaderProviderInterface
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . DIRECTORY_SEPARATOR . 'config/module.config.php';
    }

    /**
     * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
     * @return array
     */
    public function getAutoloaderConfig()
    {
        /*        return array(
                    'Zend\Loader\ClassMapAutoloader' => array(
                        __DIR__ . DIRECTORY_SEPARATOR . 'autoload_classmap.php'
                    )
                );*/

        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {

        /*return array(
            'factories' => array(
                'zfcuser_module_options' => function ($sm) {
                    $config = $sm->get('Config');
                    return new Options\ModuleOptions(isset($config['formBootstrap']) ? $config['formBootstrap'] : array());
                },
            ),
        );*/
    }

}
