<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%groups}}`.
 */
class m230302_175345_create_groups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%groups}}', [
			'id' => $this->primaryKey(),
			'group_no' => $this->integer(),
			'casino_name' => $this->string(),
			'screen_name' => $this->string(),
			'player_id' => $this->string(),
			'enrolled_at' => $this->date(),
			'no_of_sessions' => $this->integer(),
			'currency' => $this->string(),
			'turnover' => $this->string(),
			'win_loss' => $this->decimal(),
			'date_played' => $this->date(),
			'comment' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%groups}}');
    }
}
