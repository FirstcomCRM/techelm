<?php

use yii\db\Migration;

class m170419_085536_rbac_init extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // $manageArticles = $auth->createPermission('manageArticles');
        // $manageArticles->description = 'Manage articles';
        // $auth->add($manageArticles);

        // $manageUsers = $auth->createPermission('manageUsers');
        // $manageUsers->description = 'Manage users';
        // $auth->add($manageUsers);

        $staff = $auth->createRole('staff');
        $staff->description = 'Staff';
        $auth->add($staff);

        $engineer = $auth->createRole('engineer');
        $engineer->description = 'Engineer';
        $auth->add($engineer);
        // $auth->addChild($moderator, $manageArticles);

        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $auth->add($admin);
        // $auth->addChild($moderator, $manageArticles);

        $developer = $auth->createRole('developer');
        $developer->description = 'Developer';
        $auth->add($developer);
    }

    public function down()
    {
        // echo "m170419_085536_rbac_init cannot be reverted.\n";

        // return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
