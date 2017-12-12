<?php

namespace packages\actionMaris\Components;
use Bootstrap\Components\BootstrapComponent;

trait getShadowBox {

    /**
     * This will wrap your content into a shadowbox.
     *
     * @param $content -- include object that could otherwise be included in the view.
     * @return \stdClass
     */

    public function getShadowBox($content) {
        /** @var BootstrapComponent $this */
        $obj[] = $content;
        return $this->getComponentRow($obj,array('style' => 'mreg_shadowbox'));

	}

}