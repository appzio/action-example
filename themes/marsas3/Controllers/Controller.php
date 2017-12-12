<?php

/**
 * Themes model extends actions main model and further the BootstrapModel
 * @link http://docs.appzio.com/toolkit-section/models/
 */

namespace packages\actionMaris\themes\marsas3\Controllers;

use packages\actionMaris\themes\marsas3\Views\View as ArticleView;
use packages\actionMaris\themes\marsas3\Models\Model as ArticleModel;

class Controller extends \packages\actionMaris\Controllers\Controller {

    /* @var ArticleView */
    public $view;

    /* @var ArticleModel */
    public $model;
    public $title;

    public function __construct($obj){
        parent::__construct($obj);
    }

}