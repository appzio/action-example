<?php

/**
 * This is a default View file. You see many references here and in components for style classes.
 * Documentation for styles you can see under themes/example/styles
 */

namespace packages\actionMexample\Views;

use Bootstrap\Views\BootstrapView;


class View extends BootstrapView {

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
     *
     * $this->layout->header[]
     *
     * $this->layout->scroll[]
     *
     * $this->layout->footer[]
     *
     * $this->layout->onload[]
     *
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

        /**
         * get the data defined by the controller
         */
        $fieldlist = $this->getData('fieldlist','array');

        foreach($fieldlist as $field){
            $this->addField_page1($field);
        }

        /**
         *  route: Contoller/action. Controller defines the view file.
         *   this is the more complex routing just for an example. See
         *   Pagetwo.php for more straight-forward way of doing it. This
         *   can pass any number of parameters with the click.
         */

        $btn[] = $this->getComponentText('Sign Up',
            array('style' => 'mreg_btn',
                'onclick' => $this->getOnclickRoute(
                'Controller/default/signup',
              true,
                array('mytestid' => 'Flower sent from Default view','exampleid' => 393393),
                true
            )));

        $this->layout->footer[] = $this->getComponentRow($btn,array('style' => 'mreg_btn_row'));
        return $this->layout;
    }

    /**
     * Divs are containers that are loaded when action is refreshed and can be activated and hidden
     * without actually refreshing the view. This makes it possible to build very complex interactions
     * that don't require turnaround to the server, thus providing much more responsive interface for
     * the user.
     *
     * Div's are always named and referred by their names, so the getDivs must return an object with named
     * divs inside of it. To show a div, you you use OnClickShowDiv.
     *
     * In our example the showing of the div is handled by component getPhoneNumberField like this:
     * <code>
     * $this->getOnclickShowDiv('countries',$clickparams)
     * </code>
     * @return \stdClass
     */

    public function getDivs(){
        $divs = new \stdClass();

        /* look for traits under the components */
        $divs->countries = $this->components->getDivPhoneNumbers();
        return $divs;
    }

    /**
     * Model passes the fields that are configured using the webform (simple checkbox whether they are enabled
     * or not) and adds them directly on the $this->layout->scroll[].
     * @param $field
     */
    public function addField_page1($field){
        switch($field){

            case 'mreg_collect_photo':
                $this->layout->scroll[] = $this->components->getPhotoField('mreg_collect_photo');
                break;

            case 'mreg_collect_full_name':
                $content[] = $this->components->getIconField('firstname','{#first_name#}','mreg-icon-person.png');
                $content[] = $this->getDivider();
                $content[] = $this->components->getIconField('lastname','{#last_name#}');
                $this->layout->scroll[] = $this->components->getShadowBox($this->getComponentColumn($content,array(),array(
                    'width' => '100%'
                )));
                break;

            case 'mreg_collect_phone':
                $content[] = $this->components->getPhoneNumberField($this->getData('current_country','string'),'phone','{#phone#}','mreg-icon-phone.png');
                $this->layout->scroll[] = $this->components->getShadowBox($this->getComponentColumn($content,array(),array(
                    'width' => '100%'
                )));
                break;


            case 'mreg_collect_email':
                $content[] = $this->components->getIconField('email','{#email#}','mreg-icon-mail.png');
                $content[] = $this->getDivider();
                $content[] = $this->components->getIconField('password','{#password#}','mreg-icon-key.png');
                $content[] = $this->getDivider();
                $content[] = $this->components->getIconField('password_again','{#password_again#}');
                $this->layout->scroll[] = $this->components->getShadowBox($this->getComponentColumn($content,array(),array(
                    'width' => '100%'
                )));

                break;
        }
    }

    /**
     * Simple small helper for providing a divider element.
     * @return \stdClass
     */
    public function getDivider(){
        return $this->getComponentText('',array('style' => 'mreg_divider'));
    }

    /**
     * Sets a small shadow on top of the view.
     */
    public function setTopShadow(){
        $txt[] = $this->getComponentText('');
        $this->layout->header[] = $this->getComponentRow($txt, array(), array(
            'background-color' => $this->color_top_bar_color,
            'parent_style' => 'mreg_top_shadow'
        ));
    }


}