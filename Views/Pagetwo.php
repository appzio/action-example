<?php

/**
 * Its recommended to separate your main views to different files for better code organization, debugging and
 * re-usability. Your view can extend the main view file if you use shared functions in several of your views
 * or it can extend directly Bootstrap\Views\BootstrapView.
 *
 * In this view, we use divider and top shadow from the main view. Note, that if you are exending the main view,
 * and your main view includes additional tabs or divs, it can add to unneccessary payload.
 */

namespace packages\actionMexample\Views;

class Pagetwo extends View {

    /**
     * Access your components through this variable. Built-in components can be accessed also directly from the view,
     * but your custom components always through this object.
     * @var \packages\actionMexample\Components\Components
     */
    public $components;
    public $theme;

    public function __construct($obj){
        parent::__construct($obj);
    }

    /**
     * View will always need to have a function called tab1. View can include up to five tabs, named simply tab2 etc.
     * Advantage with tabs are, that all tabs are loaded when action is updated, so you can navigate between tabs
     * without doing any refreshes. To navigate to another tab, define OnClick in the following way:
     * <code>
     *  $this->getOnclickTab(2);
     * </code>
     *
     * View should always return a class, with at least one of these defined:
     * $this->layout->header[]
     * $this->layout->scroll[]
     * $this->layout->footer[]
     * $this->layout->onload[]
     * $this->layout->control[]
     *
     * Each of these sections must be an array and the array can only include objects. Be careful with types,
     * returning any other types will throw an error in the client.
     *
     * @link http://docs.appzio.com/php-toolkit/viewsbootstrapview-php/
     *
     * Data from controller is accessed using $this->getData('fieldname','array');
     *
     * Data from controller must have type defined. This is to avoid data type errors which can happen rather
     * easily without type casting.
     *
     * @return \stdClass
     */

    public function tab1(){
        $this->layout = new \stdClass();
        $this->setTopShadow();

        if($this->getData('mode', 'string') == 'close'){
            $this->layout->scroll[] = $this->getComponentFullPageLoader();
            $this->layout->onload[] = $this->getOnclickCompleteAction();
            return $this->layout;
        }

        $this->layout->scroll[] = $this->getComponentText('Your registration is nearly finished. Just fill these and you are good to go.');
        $fieldlist = $this->getData('fieldlist','array');

        foreach($fieldlist as $field){
            $this->addField_page2($field);
        }

        /* route: Contoller/action. Controller defines the view file. */
        $btn[] = $this->getComponentText('{#finish_registration#}',
            array('style' => 'mreg_btn',
                'onclick' => $this->getOnclickSubmit('done')
            ));

        $this->layout->footer[] = $this->getComponentRow($btn,array('style' => 'mreg_btn_row'));
        return $this->layout;
    }

    /**
     * Model passes the fields that are configured using the webform (simple checkbox whether they are enabled
     * or not) and adds them directly on the $this->layout->scroll[].
     * @param $field
     */

    public function addField_page2($field){
        switch($field){

            case 'mreg_collect_profile_comment':

                $textarea = $this->components->getComponentFormFieldTextArea('',array(
                    'variable' => $this->model->getVariableId('profile_comment'),
                    'hint' => $this->model->getConfigParam('mreg_hint_text_for_profile_comment')
                ));

                $this->layout->scroll[] = $this->components->getShadowBox($textarea);
                break;

        }
    }


}