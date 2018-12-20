<?php

Yii::import('application.modules.aeapi.models.*');
Yii::import('application.modules.aelogic.Bootstrap.Models.*');

/*
 * This runs any custom migrations needed by the action module. These migrations
 * are run even if the action is not defined to the app. Having an error here can
 * cause problems with deployment as cloud deployments will run migrations automatically
 * upon pod deployment.
 *
 * NOTE:
 * Actions migrations are run in alphabetical order. This might lead to problems with
 * constraints if you need to have relations between actions. If you have relations
 * between the actions, the constraints should be set by the last action (alphabetically).
 *
 * You can use the following helper functions:
 *
 * helperActionExists($shortname)
 * helperDropRelation($table,$relation)
 * helperGetRelationName($table, $target)
 * helperRelationExists($table, $column, $target)
 * helperTableExists($tablename)
 * helperColumnExists($column, $table)
 *
 * Database tables should always start with:
 * ae_ext_youractionshortname
 *
 * Its usually recommended to encapsulate more complex updates inside transaction,
 * this if the migration fails, it doesn't crash. Faulty migration will prevent rest
 * of the migrations from running if its not inside transaction.
 *
 */

class MigrationsactionMexample extends BootstrapMigrations {

    /* set these so that the action will get created automatically */
    public $title = 'Mobile Example';
    public $icon = 'new.png';
    public $description = 'Example module';

    public function runModuleMigrations(){
        $this->exampleMigration();
        return true;
    }

    /* example on how to run an external sql file */
    private function exampleMigration(){
        if(self::helperTableExists('ae_game')){
            $this->runMigrationFromFile('tables.sql');
        }
    }


}