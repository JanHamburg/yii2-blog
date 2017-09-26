<?php

use yii\db\Migration;

/**
 * Class m170926_093551_add_columns_to_blog_catalog
 */
class m170926_093551_add_columns_to_blog_catalog extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_catalog}}', 'slug', Schema::TYPE_STRING);
        $this->addColumn('{{%blog_post}}', 'slug', Schema::TYPE_STRING);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m170926_093551_add_columns_to_blog_post cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170926_093551_add_columns_to_blog_post cannot be reverted.\n";

        return false;
    }
    */
}
