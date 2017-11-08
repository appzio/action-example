<?php

/**
 * Themes model extends actions main model and further the BootstrapModel
 * @link http://docs.appzio.com/toolkit-section/models/
 */

namespace packages\actionMexample\themes\example\Controllers;

use packages\actionMexample\themes\example\Views\View as ArticleView;
use packages\actionMexample\themes\example\Models\Model as ArticleModel;

class Controller extends \packages\actionMexample\Controllers\Controller {

    /* @var ArticleView */
    public $view;

    /* @var ArticleModel */
    public $model;
    public $title;

    public function __construct($obj){
        parent::__construct($obj);
    }

}