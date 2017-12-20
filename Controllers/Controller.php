<?php

/**
 * This example shows a simple registration form. Usually this action would be used in conjuction with
 * Mobilelogin action, which provides login and logout functionalities.
 *
 * Default controller for your action. If no other route is defined, the action will default to this controller
 * and its default method actionDefault() which must always be defined.
 *
 * In more complex actions, you would include different controller for different modes or phases. Organizing
 * the code for different controllers will help you keep the code more organized and easier to understand and
 * reuse.
 *
 * Unless controller has $this->no_output set to true, it should always return the view file name. Data from
 * the controller to view is passed as a second part of the return array.
 *
 * Theme's controller extends this file, so usually you would define the functions as public so that they can
 * be overriden by the theme controller.
 *
 */

namespace packages\actionMexample\Controllers;
use Bootstrap\Controllers\BootstrapController;
use packages\actionMexample\Views\View as ArticleView;
use packages\actionMexample\Models\Model as ArticleModel;

class Controller extends BootstrapController {

    /**
     * @var ArticleView
     */
    public $view;

    /**
     * Your model and Bootstrap model methods are accessible through this variable
     * @var ArticleModel
     */
    public $model;

    /**
     * This is the default action inside the controller. This function gets called, if
     * nothing else is defined for the route
     * @return array
     */
    public function actionDefault(){

        /**
         * if user has already completed the first phase, move to phase 2
         */
        if($this->model->sessionGet('reg_phase') == 2){
            return $this->actionPagetwo();
        }

        $data['fieldlist'] = $this->model->getFieldlist();
        $data['current_country'] = $this->model->getCountry();

        /**
         * If user has clicked the signup, we will first validate
         * and then save the data. Validation errors are also available to views and components.
         */

        if($this->getMenuId() == 'signup'){
            $this->model->validatePage1();

            if(empty($this->model->validation_errors)){
                /**
                 * If validation succeeds, we save data to variables and move user to page 2
                 */
                $this->model->savePage1();
                $this->model->sessionSet('reg_phase', 2);
                return ['Pagetwo',$data];
            }
        }

        return ['View',$data];
    }


    /**
     * This function can be invoked by the controllers main method, of if you define an OnClick
     * event routing directly to this. In order to change the actions route to point to this controller
     * function, you would define it like this:
     * <code>
     *   $this->getOnclickRoute('Default/pagetwo/');
     * </code>
     *
     * And in order to invoke the "done" portion of the controller, you would define it as:
     * <code>
     *   $this->getOnclickRoute('Default/pagetwo/done');
     * </code>

     * @return array
     */
    public function actionPagetwo(){

        $data['mode'] = 'show';

        /* no validation here */
        if($this->getMenuId() == 'done'){
            $this->model->closeLogin();
            $data['mode'] = 'close';
        }

        return ['Pagetwo',$data];

    }



}