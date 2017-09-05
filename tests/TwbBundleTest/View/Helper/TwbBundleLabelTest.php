<?php
namespace TwbBundleTest\View\Helper;
class TwbBundleLabelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \FormBootstrap\View\Helper\BootstrapLabel
     */
    protected $labelHelper;

    /**
     * @see \PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('view_helper_manager');
        $oRenderer = new \Zend\View\Renderer\PhpRenderer();
        $this->labelHelper = $oViewHelperPluginManager->get('label')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRenderWithWrongTypeAttributes()
    {
        $this->labelHelper->render('test', new \stdClass());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRenderWithEmptyClassAttributes()
    {
        $this->labelHelper->render('test', array('class' => ''));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRenderWithWrongTypeClassAttributes()
    {
        $this->labelHelper->render('test', array('class' => new \stdClass()));
    }
}