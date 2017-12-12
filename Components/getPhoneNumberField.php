<?php

namespace packages\actionMaris\Components;
use Bootstrap\Components\BootstrapComponent;

trait getPhoneNumberField {


    /**
     * @param string $country -- country name
     * @param $field -- field name or id
     * @param string $title -- Title for the field. Recommended to be provided as a localization string like this: {#name#}
     * @param string $icon -- Icon file name. Icon should be put under images directory.
     * @return \stdClass
     */
    public function getPhoneNumberField(string $country, $field, string $title, string $icon=''){
        /** @var BootstrapComponent $this */

        $params['variable'] = $field;
        $params['hint'] = $title;
        $params['style'] = 'mreg_fieldtext';
        $params['input_type'] = 'phone';

        if($icon){
            $col[] = $this->getComponentImage($icon,array('style' => 'mreg_icon_field'));
        } else {
            $col[] = $this->getComponentText('',array('style' => 'mreg_icon_field'));
        }

        $countrycodes = array_flip($this->model->getCountryCodes());

        if(isset($countrycodes[$country])){
            $c = strtolower($countrycodes[$country]);
        } else {
            $c = 'bulgaria';
        }

        $flag = 'flag_' .$c .'.png';
        $clickparams['layout'] = new \stdClass();
        $clickparams['layout']->bottom = 'tap';
        $clickparams['layout']->left = '50';
        $clickparams['layout']->right = '50';
        $clickparams['transition'] = 'fade';
        $clickparams['tap_to_close'] = '1';

        $test = $this->getImageFileName($flag);
        if($test){
            $col[] = $this->getComponentImage($flag,array('style' => 'mreg_icon_field','onclick' => $this->getOnclickShowDiv('countries',$clickparams)));
        } else {
            $col[] = $this->getComponentImage('flag_questionmark.png',array('style' => 'mreg_icon_field','onclick' => $this->getOnclickShowDiv('countries',$clickparams)));
        }

        if(stristr($field, 'password')){
            $col[] = $this->getComponentFormFieldPassword($this->model->getSubmittedVariableByName($field),$params);
        } else {
            $col[] = $this->getComponentFormFieldText($this->model->getSubmittedVariableByName($field),$params);
        }

        if(isset($this->model->validation_errors[$field])){
            $row[] = $this->getComponentText($this->model->validation_errors[$field],array('style' => 'mreg_error'));
            $row[] = $this->getComponentRow($col,array(),array('vertical-align' => 'middle'));
            return $this->getComponentColumn($row);
        }

        return $this->getComponentRow($col,array(),array('vertical-align' => 'middle'));
    }

}