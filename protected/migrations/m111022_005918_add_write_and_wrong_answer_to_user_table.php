<?php

class m111022_005918_add_write_and_wrong_answer_to_user_table extends CDbMigration
{
	public $table = 'anonymous_user';

	public function up()
	{
		$this->addColumn( 
			$this->table,
			'good_answers',
			'int default 0'
		);

		$this->addColumn( 
			$this->table,
			'bad_answers',
			'int default 0'
		);
	}

	public function down()
	{
		$this->dropColumn(
			$this->table,
			'good_answers'
		);

		$this->dropColumn(
			$this->table,
			'bad_answers'
		);
	}
}
