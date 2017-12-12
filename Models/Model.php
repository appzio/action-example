<?php

/**
 * Default model for the action. It has access to all data provided by the BootstrapModel.
 *
 * @link http://docs.appzio.com/toolkit-section/models/
 */

namespace packages\actionMaris\Models;
use Bootstrap\Models\BootstrapModel;

class Model extends BootstrapModel {

    /**
     * This variable doesn't actually need to be declared here, but but here for documentation's sake.
     * Validation erorr is an array where validation errors are saved and can be accessed by controller,
     * view and components.
     */
    public $validation_errors;

    private $password;
    private $phone;
    private $email;
    private $firstname;
    private $lastname;


    /**
     * Gets a list of configuration fields from the web form configuration. These are used by the view.
     * @return array
     */
    public function getFieldList(){
        $params = $this->getAllConfigParams();
        $output = array();

        foreach($params as $key=>$item){
            if(stristr($key, 'mreg') AND $item){
                $output[] = $key;
            }
        }

        return $output;
    }

    /**
     * Active selected country for the phone number field
     */
    public function getCountry(){

        if($this->getSubmittedVariableByName('country_selected')){
            $country = $this->getSubmittedVariableByName('country_selected');
            $this->sessionSet('selected_country', $country);
        } elseif($this->sessionGet('country')){
            $country = $this->sessionGet('selected_country');
        } else {
            $country = '+44';
        }

        return $country;
    }

    /**
     * Save to variables. Called by controller if there are no validation errors.
     */
    public function savePage1(){
        $vars['password'] = sha1(strtolower(trim($this->password)));
        $vars['email'] = $this->email;
        $vars['phone'] = $this->phone;
        $vars['firstname'] = $this->firstname;
        $vars['lastname'] = $this->lastname;
        $vars['real_name'] = $this->firstname .' ' .$this->lastname;
        $this->saveNamedVariables($vars);
    }

    /**
     * Will do a basic validation for all submitted variables and save any errors
     * to validation_errors. Validation errors are read by the field components directly,
     * so that they can display error version of the field along with the validation message.
     * Notice how all validation errors are defined as translation strings making it easy to
     * localize the application.
     */
    public function validatePage1(){
        $vars = $this->getAllSubmittedVariablesByName();

        foreach($vars as $key=>$var){

            switch ($key){
                case 'firstname':
                    $this->firstname = strtolower($var);
                    $this->firstname = ucwords($this->firstname);
                    if(strlen($var) < 2){
                        $this->validation_errors[$key] = '{#please_input_a_valid_first_name#}';
                    }
                    break;

                case 'lastname':
                    $this->lastname = strtolower($var);
                    $this->lastname = ucwords($this->lastname);
                    if(strlen($var) < 2) {
                        $this->validation_errors[$key] = '{#please_input_a_valid_last_name#}';
                    }
                    break;

                case 'email':
                    $this->email = strtolower($var);
                    
                    if(!$this->validateEmail($this->email)){
                        $this->validation_errors[$key] = '{#please_input_a_valid_email#}';
                    }
                    break;

                case 'password':
                    $this->password = $var;

                    if(!$this->validatePassword($var)){
                        $this->validation_errors[$key] = '{#password_needs_to_be_at_least_four_characters#}';
                    }

                    break;

                case 'password_again':
                    if($this->getSubmittedVariableByName('password') != $var){
                        $this->validation_errors[$key] = '{#passwords_dont_match#}';
                    }
                    break;

                case 'phone':
                    $this->phone = str_replace(' ', '', $var);
                    if(!is_numeric($this->phone)){
                        $this->validation_errors[$key] = '{#please_only_input_numbers#}';
                    }

                    if(strlen($this->phone) < 5){
                        $this->validation_errors[$key] = '{#please_enter_a_valid_phone_number#}';
                    }

                    break;

            }
        }
    }

    /**
     * This is a special function for registration, which sets required variables to complete registration
     * and closes the login branch. After registration is completed it will close both login and registration
     * actions. You can the use branch triggering by setting your home branch to trigger when logged_in is
     * set to 1. Login branch is defined in the action's configuration.
     */

    public function closeLogin($dologin=true){
        if ($this->getConfigParam('require_login') == 1) {
            return true;
        }

        $this->saveVariable('reg_phase','complete');

        $branch = $this->getConfigParam('login_branch');

        if($dologin){
            $this->saveVariable('logged_in',1);
        }

        if(!$branch){
            return false;
        }

        \AeplayBranch::closeBranch($branch,$this->playid);
        return true;
    }


}