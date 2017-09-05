<?php

namespace FormBootstrap\Form\View\Helper;

use DomainException;
use Zend\Form\Element\Button;
use Zend\Form\Element\Submit;
use Zend\Form\ElementInterface;
use Zend\Form\LabelAwareInterface;
use Zend\Form\View\Helper\FormRow;

/**
 * Class BootstrapFormRowCustom
 * @package FormBootstrap\Form\View\Helper
 *
 * Sobrescrever os atributos da classe a partir de parametros de configuracao fornecido ao metodo render
 * Um Classe Custom é importante por que a factory para criacao das instancias de FormRow preserva a instancia criada
 * Nao otive exito em gerenciar o uso dos atributos static na renderizacao dos elementos, por este motivo foi feita a
 *  sobrecarga do metodo render e atributos da classe
 */
class BootstrapFormRowCustom extends BootstrapFormRow
{
    /**
     * @var string
     * A class form-no-group foi acrescentada para permitir posicionar form-groups em uma mesma linha
     */
    protected static $formGroupFormat = '<div class="form-group form-no-group %s">%s</div>';

    /**
     * @var string
     */
    protected static $horizontalLayoutFormat = '<div class="%s">%s</div>';

    /**
     * @var string
     */
    protected static $checkboxFormat = '<div class="checkbox">%s</div>';

    /**
     * @var string
     */
    protected static $helpBlockFormat = '<p class="help-block">%s</p>';

    /**
     * @var string
     */
    protected $labelClassSize = 'col-sm-2';

    /**
     * @var string
     */
    protected $fieldClassSize = 'col-sm-10';


    /**
     * The class that is added to element that have errors
     * @var string
     */
    protected $inputErrorClass = '';

    /**
     * @var string
     */
    protected $requiredFormat = null;

    protected $form;

    protected $formLayout;

    /**
     * @see FormRow::render()
     * @param ElementInterface $oElement
     * @return string
     */
    public function render(ElementInterface $oElement, $attributes = array())
    {
        if(isset($attributes) && is_array($attributes)) {
            foreach ($attributes as $attrToOverlay => $value) {
                if( property_exists($this, $attrToOverlay ) ){
                    $prop = new \ReflectionProperty('FormBootstrap\Form\View\Helper\BootstrapFormRow', $attrToOverlay);
                    if($prop->isStatic()){
                        self::$$attrToOverlay = $value;
                    } else {
                        $this->$attrToOverlay = $value;
                    }
                }
            }
        }

        $sElementType = $oElement->getAttribute('type');

        //Nothing to do for hidden elements which have no messages
        if ($sElementType === 'hidden' && !$oElement->getMessages()) {
            return parent::render($oElement);
        }

        //Retrieve expected layout
        $sLayout = $this->getElementLayout($oElement);

        //Partial rendering
        if ($this->partial) {
            return $this->view->render($this->partial, array(
                'element' => $oElement,
                'label' => $this->renderLabel($oElement),
                'labelAttributes' => $this->labelAttributes,
                'labelPosition' => $this->labelPosition,
                'renderErrors' => $this->renderErrors,
            ));
        }

        $sRowClass = '';

        //Validation state
        if (($sValidationState = $oElement->getOption('validation-state'))) {
            $sRowClass .= ' has-' . $sValidationState;
        }

        //"has-error" validation state case
        if ($oElement->getMessages()) {
            $sRowClass .= ' has-error';
            //Element have errors
            if ($sInputErrorClass = $this->getInputErrorClass()) {
                if ($sElementClass = $oElement->getAttribute('class')) {
                    if (!preg_match('/(\s|^)' . preg_quote($sInputErrorClass, '/') . '(\s|$)/', $sElementClass)) {
                        $oElement->setAttribute('class', trim($sElementClass . ' ' . $sInputErrorClass));
                    }
                } else {
                    $oElement->setAttribute('class', $sInputErrorClass);
                }
            }
        }

        //Column size
        if (($sColumSize = $oElement->getOption('column-size')) && $sLayout !== BootstrapForm::LAYOUT_HORIZONTAL) {
            $sRowClass .= ' col-' . $sColumSize;
        }

        //Render element
        $sElementContent = $this->renderElement($oElement);

        //Render form row
        if ($sElementType === 'checkbox' && $sLayout !== BootstrapForm::LAYOUT_HORIZONTAL) {
            return $sElementContent . PHP_EOL;
        }
        if (($sElementType === 'submit' || $sElementType === 'button' || $sElementType === 'reset')
            && $sLayout === BootstrapForm::LAYOUT_INLINE
        ) {
            return $sElementContent . PHP_EOL;
        }

        return sprintf(self::$formGroupFormat, $sRowClass, $sElementContent) . PHP_EOL;
    }

}
