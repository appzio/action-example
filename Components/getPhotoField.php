<?php

namespace packages\actionMexample\Components;
use Bootstrap\Components\BootstrapComponent;

trait getPhotoField {


    /**
     * @param string $content -- optional field for defining different default picture. If variable profilepic is set,
     * it will be used instead.
     * @return \stdClass
     */
    public function getPhotoField(string $pic='', array $parameters=array(), array $styles=array()) {
        /** @var BootstrapComponent $this */

        if($this->model->getSavedVariable('profilepic')){
            $pic = $this->model->getSavedVariable('profilepic');
        } elseif(!$pic) {
            $pic = 'icon_camera-grey.png';
        }

        $obj[] = $this->getComponentImage($pic,array(
            'style' => 'mreg_pic',
            'variable' => $this->model->getVariableId('profilepic'),
            'onclick' => $this->getOnclickImageUpload('profilepic',array('max_dimensions' => '900'))
        ));

        $row[] = $this->getComponentRow($obj,array(
            'style' => 'mreg_picshadow'
        ));

        return $this->getComponentRow($row,array('style' => 'mreg_picrow'));

	}

}