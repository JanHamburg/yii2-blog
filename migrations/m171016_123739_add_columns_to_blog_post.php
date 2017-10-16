<?php

use yii\db\Migration;

/**
 * Class m171016_123739_add_columns_to_blog_post
 */
class m171016_123739_add_columns_to_blog_post extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_post}}', 'author', $this->string()->null());
        $this->addColumn('{{%blog_post}}', 'photograph', $this->string()->null());
        $this->addColumn('{{%blog_post}}', 'place', $this->string()->null());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171016_123739_add_columns_to_blog_post cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171016_123739_add_columns_to_blog_post cannot be reverted.\n";

        return false;
    }
    */
}
