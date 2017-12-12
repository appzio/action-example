<?php

namespace packages\actionMaris\Components;
use Bootstrap\Components\BootstrapComponent;

trait getIconField {

    /**
     * This will automatically set input type for eamil, phone and password accordingly, based on the $field
     *
     * @param $field -- Field name or ID. This is accessible from the model when view is submitted.
     * @param string $title -- Title for the field. Recommended to be provided as a localization string like this: {#name#}
     * @param string $icon -- Icon file name. Icon should be put under images directory.
     * @return \stdClass
     */
    public function getIconField($field, string $title, $icon=''){
        /** @var BootstrapComponent $this */

        $params['variable'] = $field;
        $params['hint'] = $title;
        $params['style'] = 'mreg_fieldtext';

        if($field == 'email'){
            $params['input_type'] = 'email';
        }elseif($field == 'phone'){
            $params['input_type'] = 'numeric';
        }

        if($icon){
            $col[] = $this->getComponentImage($icon,array('style' => 'mreg_icon_field'));
        } else {
            $col[] = $this->getComponentText('',array('style' => 'mreg_icon_field'));
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