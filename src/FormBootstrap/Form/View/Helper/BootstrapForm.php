<?php
namespace FormBootstrap\Form\View\Helper;

use FormBootstrap\Options\ModuleOptions;
use Zend\Form\FieldsetInterface;
use Zend\Form\FormInterface;
use Zend\Form\View\Helper\Form;

class BootstrapForm extends Form
{
    const LAYOUT_HORIZONTAL = 'horizontal';
    const LAYOUT_INLINE = 'inline';

    /**
     * @var string
     */
    private static $formRowFormat = '<div class="row">%s</div>';

    /**
     * Form layout (see LAYOUT_* consts)
     *
     * @var string
     */
    protected $formLayout = null;


    protected $options;


    protected $excludedField = array();
    protected $excludedTypes = array();

    public function __construct(ModuleOptions $options)
    {
        $this->options = $options;
    }

    /**
     * @see Form::__invoke()
     * @param FormInterface $oForm
     * @param string $sFormLayout
     * @return BootstrapForm|string
     */
    public function __invoke(FormInterface $oForm = null, $sFormLayout = null)
    {
        if (is_null($sFormLayout)) {
            $sFormLayout = $this->options->getDefaultLayout();
        }

        if ($oForm) {
            return $this->render($oForm, $sFormLayout);
        }

        $this->formLayout = $sFormLayout;
        return $this;
    }

    /**
     * Render a form from the provided $oForm,
     * @see Form::render()
     * @param FormInterface $oForm
     * @param string $sFormLayout
     * @return string
     */
    public function render(FormInterface $oForm, $sFormLayout = self::LAYOUT_HORIZONTAL)
    {
        //Prepare form if needed
        if (method_exists($oForm, 'prepare')) {
            $oForm->prepare();
        }

        $this->setFormClass($oForm, $sFormLayout);

        //Set form role
        if (!$oForm->getAttribute('role')) {
            $oForm->setAttribute('role', 'form');
        }

        $bHasColumnSizes = false;
        $sFormContent = '';
        $oRenderer = $this->getView();
        foreach ($oForm as $oElement) {
            $aOptions = $oElement->getOptions();
            if (!$bHasColumnSizes && !empty($aOptions['column-size'])) {
                $bHasColumnSizes = true;
            }
            //Define layout option to form elements if not already defined
            if ($sFormLayout && empty($aOptions['twb-layout'])) {
                $aOptions['twb-layout'] = $sFormLayout;
                $oElement->setOptions($aOptions);
            }
            $sFormContent .= $oElement instanceof FieldsetInterface ? $oRenderer->formCollection($oElement) : $oRenderer->formRow($oElement);
        }
        if ($bHasColumnSizes && $sFormLayout !== self::LAYOUT_HORIZONTAL) {
            $sFormContent = sprintf(self::$formRowFormat, $sFormContent);
        }
        return $this->openTag($oForm) . $sFormContent . $this->closeTag();
    }

    /**
     * Sets form layout class
     *
     * @param FormInterface $oForm
     * @param string $sFormLayout
     * @return void
     */
    protected function setFormClass(FormInterface $oForm, $sFormLayout = self::LAYOUT_HORIZONTAL)
    {
        if (is_string($sFormLayout)) {
            $sLayoutClass = 'form-' . $sFormLayout;
            if ($sFormClass = $oForm->getAttribute('class')) {
                if (!preg_match('/(\s|^)' . preg_quote($sLayoutClass, '/') . '(\s|$)/', $sFormClass)) {
                    $oForm->setAttribute('class', trim($sFormClass . ' ' . $sLayoutClass));
                }
            } else {
                $oForm->setAttribute('class', $sLayoutClass);
            }
        }
    }

    /**
     * Generate an opening form tag
     *
     * @param  null|FormInterface $form
     * @return string
     */
    public function openTag(FormInterface $form = null)
    {
        $this->setFormClass($form, $this->formLayout);
        return parent::openTag($form);
    }

    /**
     * @return ModuleOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ModuleOptions $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getFormLayout()
    {
        return $this->formLayout;
    }

    /**
     * @param string $formLayout
     */
    public function setFormLayout($formLayout)
    {
        $this->formLayout = $formLayout;
    }

    /**
     * @return array
     */
    public function getExcludedField()
    {
        return $this->excludedField;
    }

    /**
     * @param array $excludedField
     */
    public function setExcludedField($excludedField)
    {
        if (is_array($excludedField)) {
            $this->excludedField = $excludedField;
        } else {
            $this->excludedField[] = $excludedField;
        }
    }

    /**
     * @return array
     */
    public function getExcludedTypes()
    {
        return $this->excludedTypes;
    }

    /**
     * @param array $excludedTypes
     */
    public function setExcludedTypes($excludedTypes)
    {
        if (is_array($excludedTypes)) {
            $this->excludedTypes = $excludedTypes;
        } else {
            $this->excludedTypes[] = $excludedTypes;
        }
    }

}
