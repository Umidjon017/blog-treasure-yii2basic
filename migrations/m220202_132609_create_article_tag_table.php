<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_tag}}`.
 */
class m220202_132609_create_article_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_tag}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        // create index for article_id
        $this->createIndex(
            'idx-article_tag-article_id',
            'article_tag',
            'article_id'
        );

        // add foreign Key for article
        $this->addForeignKey(
            'fk-article_tag-article_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        // create index for tag_id
        $this->createIndex(
            'idx-article_tag-tag_id',
            'article_tag',
            'tag_id'
        );

        // add foreign Key for tag
        $this->addForeignKey(
            'fk-article_tag-tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article_tag}}');
    }
}
