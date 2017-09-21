<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m170921_063915_modifications_in_blog_tables
 */
class m170921_063915_modifications_in_blog_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn('{{%blog_catalog}}', 'with_likes', Schema::TYPE_BOOLEAN . ' DEFAULT 0');
        $this->addColumn('{{%blog_post}}', 'likes', Schema::TYPE_INTEGER . '(11) default 0');
        $this->addColumn('{{%blog_post}}', 'with_donations', Schema::TYPE_BOOLEAN . ' default 0');
        $this->addColumn('{{%blog_post}}', 'amount', Schema::TYPE_INTEGER . '(11) default 0');
        $this->addColumn('{{%blog_post}}', 'donated', Schema::TYPE_INTEGER . '(11) default 0');
        $this->addColumn('{{%blog_post}}', 'in_top', Schema::TYPE_BOOLEAN . ' default 0');

        $this->createTable(
            '{{%blog_post_like}}',
            [
                'post_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'user_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ],
            $tableOptions
        );

        $this->createIndex(
            'user_liked_post',
            '{{%blog_post_like}}',
            ['post_id', 'user_id'],
            true
        );

        $this->createIndex(
            'post_likes',
            '{{%blog_post_like}}',
            'post_id'
        );

        $this->createIndex(
            'user_liked',
            '{{%blog_post_like}}',
            'user_id'
        );


        $this->createTable(
            '{{%blog_post_donation}}',
            [
                'id' => $this->primaryKey(),
                'post_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'user_id' => Schema::TYPE_INTEGER,
                'anonymous' => Schema::TYPE_BOOLEAN . ' DEFAULT 0',
                'username' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'amount' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'transaction_id' => Schema::TYPE_STRING,
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ],
            $tableOptions
        );

        $this->createIndex(
            'transactions',
            '{{%blog_post_donation}}',
            'transaction_id'
        );

        $this->createIndex(
            'post_transactions',
            '{{%blog_post_donation}}',
            'post_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m170921_063915_modifications_in_blog_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170921_063915_modifications_in_blog_tables cannot be reverted.\n";

        return false;
    }
    */
}
