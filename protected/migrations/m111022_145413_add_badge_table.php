<?php

class m111022_145413_add_badge_table extends CDbMigration
{
	public $table = 'badge';

	public function up()
	{
		$this->createTable(
			$this->table,
			array(
				'id'			=> 'pk',
				'name'			=> 'varchar(100) not null',
				'description'	=> 'text',
				'level'			=> 'int',
				'picture'		=> 'string'
			),
			'ENGINE=InnoDB default charset=utf8'
		);
	}

	public function down()
	{
		$this->dropTable( $this->table );
	}
}
