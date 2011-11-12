<?php
class m111112_005904_add_last_king_column_to_user extends CDbMigration
{
	public $table = 'anonymous_user';

	public function up()
	{
		$this->addColumn( 
			$this->table,
			'last_time_king',
			'int'
		);
	}

	public function down()
	{
		$this->dropColumn(
			$this->table,
			'last_time_king'
		);
	}
}
