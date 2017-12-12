<?php

namespace packages\actionMaris\Components;
use Bootstrap\Components\BootstrapComponent;

trait getDivPhoneNumbers {

    /**
     * This will return a div content when user has clicked on the country selector in the getPhoneNumberField.
     *
     * This div can be included by the view or it can also be registred by another component, by adding:
     * <code>
     * $this->addDivs(array('countries' => 'getDivPhoneNumbers'));
     * </code>
     * @return \stdClass
     * @link packages\actionMaris\Components\getPhoneNumberField
     */

    public function getDivPhoneNumbers(){
        /** @var BootstrapComponent $this */

        /**
         * This is an access method from the Bootstrap main level
         */
        $countrycodes = $this->model->getCountryCodes();
        $ouput = array();
        $list = '';

        foreach ($countrycodes as $name => $code){
            $list .= $code .';' .$name .';';
        }

        $list = substr($list, 0,-1);


        $value = $this->model->getSubmittedVariableByName('selected_country') ? $this->model->getSubmittedVariableByName('selected_country') : $this->model->sessionGet('selected_country');


        $content[] = $this->getComponentFormFieldList($list,array(
            'variable' => 'country_selected',
            'style' => 'mreg_selectlist',
            'value' => $value
        ));

        $cols[] = $this->getComponentText('{#cancel#}',array('style' => 'mreg_small_btn','onclick' => $this->getOnclickHideDiv('countries')));
        $cols[] = $this->getComponentText('{#select#}',array('style' => 'mreg_small_btn',
            'onclick' => $this->getOnclickSubmit('selectcountry')
        )
        );

        $content[] = $this->getComponentRow($cols,array(),array(
            'text-align' => 'center'
        ));

        return $this->getComponentColumn($content,array(
            'style' => 'mreg_divbox'
        ),array(

        ));


    }

}