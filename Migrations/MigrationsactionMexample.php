<?php

Yii::import('application.modules.aeapi.models.*');

/*
 * This runs any custom migrations needed by the action module. These migrations
 * are run even if the action is not defined to the app. Having an error here can
 * cause problems with deployment as cloud deployments will run migrations automatically
 * upon pod deployment.
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
 *
 */

class MigrationsactionMexample extends Migrations {

    public static function runModuleMigrations(){
        self::createExampleAction();
        return true;
    }

    private static function createExampleAction()
    {
        if(self::helperActionExists('mexample')){
            return false;
        }

        $sql = "
          INSERT INTO `ae_game_branch_action_type` (`title`, `icon`, `shortname`, `id_user`, `description`, `version`, `channels`, `uiformat`, `active`, `global`, `githubrepo`, `adminfeedback`, `requestupdate`, `uses_table`, `has_statistics`, `has_export`, `invisible`, `hide_from_api`, `ios_supports`, `android_supports`, `web_supports`, `article_view`,`library`) VALUES
          ('Mobile Example', 'new.png', 'mexample', 1, '<p>Example module</p>', '1', '', 'native', 1, 1, '', '', 0, 0, 0, 0, 0, 0, 1, 1, 0, 1,'PHP2');
        ";

        @Yii::app()->db->createCommand($sql)->query();
    }


    private static function exampleMigration(){
        if(!self::helperTableExists('ae_ext_example')) {
            $path = Yii::getPathOfAlias('application.modules.aelogic.packages.actionMexample.Migrations');
            $sql = file_get_contents($path . DS . 'tables.sql');
            @Yii::app()->db->createCommand($sql)->query();
        }
    }

    private static function exampleAppSpecific(){
        // this will run only if its executed from the admin dashboard, not automatically on pod deployment
        if(isset($_REQUEST['gid'])){
            if(!self::helperTableExists('ae_ext_example')){
                $path = Yii::getPathOfAlias('application.modules.aelogic.packages.actionMexample.Migrations');
                $sql = file_get_contents($path.DS.'tables.sql');
                $sql = str_replace('{{app_id}}', $_REQUEST['gid'], $sql);
                @Yii::app()->db->createCommand($sql)->query();
            }
        }
    }


}