<?php

/**
 * This is an example of a model which uses custom database table. Please refer to YII 1.1.19 documentation
 * on how to work with ActiveRecord. To use this class in your main Model.php, you could do this for example:
 * <code>
 *   $categories = ProductcategoriesModel::model()->findAllByAttributes(array('app_id' => $this->app_id));
 * </code>
 *
 * When defining custom database columns for your action, make sure to include app_id column, which should
 * always be set with you app_id, which is available in your main model as $this->app_id. If record is user
 * specific, include play_id column, and populate it within the main model using $this->playid. These columns
 * should have relations set to ae_game (for app_id) and ae_play (for play_id) with a cascade on delete. This
 * way when user or app is deleted, also the related records get cleaned up.
 *
 * Example of creating a new record:
 * <code>
 *   $new_record = new ProductcategoriesModel();
 *   $new_record->app_id = $this->app_id;
 *   $new_record->title = '{#my_category_title#}';
 *   $new_record->insert();
 * </code>
 *
 */

namespace packages\actionMaris\Models;
use CActiveRecord;

class ProductcategoriesModel extends CActiveRecord {

    public $id;
    public $app_id;
    public $title;
    public $sorting;

    public function tableName()
    {
        return 'ae_ext_products_categories';
    }

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'product' => array(self::BELONGS_TO, 'packages\actionMproducts\Models\ProductitemsModel', 'product_id'),
        );
    }



}
