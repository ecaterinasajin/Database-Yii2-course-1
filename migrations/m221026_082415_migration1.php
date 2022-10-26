<?php

use yii\db\Migration;

/**
 * Class m221026_082415_migration1
 */
class m221026_082415_migration1 extends Migration
{
    /** {@inheritdoc} */

    public function safeUp()
    {
       /* $this->createTable('{{%user1}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(55)->notNull()->unique(),
            'email' => $this->string()->notNull(),
        ]); */

        $this->createTable('{{%user1}}', ['id' => $this->primaryKey(),
                                     'usern' => $this->string(255)->notNull(),
                                     'status' => $this->boolean(),
                                     'created_at' => $this->integer()
                                     ]);
        $this->addColumn('{{%user1}}', 'email', $this->string(512)->notNull());

        $this->createTable('{{%post}}',['id' => $this->primaryKey(),
                                   'title' => $this->string(),
                                   'user_id' => $this->integer()
                                  ]);
        $this->addForeignKey('FK_post_user', '{{%post}}', 'user_id', '{{%user1}}', 'id');

        $this->insert('{{%user1}}', [ 'usern' => 'Kate',
                                      'email' => 'kate@gmail.com',
                                      'status' => 1,
                                      'created_at' => time()
                                    ]);
    }

    /** {@inheritdoc} */
    public function safeDown()
    {
        $this->dropForeignKey('FK_post_user', '{{%post}}');
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%user1}}');
    }

    /*// Use up()/down() to run migration code without a transaction.
    public function up(){}
    public function down()
    {
        echo "m221026_074112_first_migration cannot be reverted.\n";
        return false;
    }*/
}
