<?php

namespace FormBootstrap\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Hold options for FormBootstrap module
 */
class ModuleOptions extends AbstractOptions
{

    protected $defaultLayout = 'horizontal';


    /**
     * @var bool
     */
    protected $teste = true;

    protected $ignoredViewHelpers = array();

    public function getIgnoredViewHelpers()
    {
        return $this->ignoredViewHelpers;
    }

    public function setIgnoredViewHelpers($ignoredViewHelpers)
    {
        $this->ignoredViewHelpers = $ignoredViewHelpers;
    }

    /**
     * @return boolean
     */
    public function isTeste()
    {
        return $this->teste;
    }

    /**
     * @param boolean $teste
     */
    public function setTeste($teste)
    {
        $this->teste = $teste;
    }

    /**
     * @return string
     */
    public function getDefaultLayout()
    {
        return $this->defaultLayout;
    }

    /**
     * @param string $defaultLayout
     */
    public function setDefaultLayout($defaultLayout)
    {
        $this->defaultLayout = $defaultLayout;
    }


}
