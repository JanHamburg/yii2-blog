<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m171006_124619_additional_columns_in_blog_catalog_and_blog_post
 */
class m171006_124619_additional_columns_in_blog_catalog_and_blog_post extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_catalog}}', 'news_category', $this->boolean()->defaultValue(false));
        $this->addColumn('{{%blog_post}}', 'results', $this->text());
        $this->addColumn('{{%blog_post}}', 'gratitude', $this->text());
        $this->addColumn('{{%blog_post}}', 'closed', $this->boolean()->defaultValue(false));
        $this->addColumn('{{%blog_post}}', 'special_help', $this->boolean()->defaultValue(false));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171006_124619_additional_columns_in_blog_catalog_and_blog_post cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171006_124619_additional_columns_in_blog_catalog_and_blog_post cannot be reverted.\n";

        return false;
    }
    */
}
