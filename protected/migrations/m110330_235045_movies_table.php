<?php

class m110330_235045_movies_table extends CDbMigration
{
	public $table = 'movies';

	public function up()
	{
		$this->createTable( $this->table, array(
			'id' 		=> 'pk',
			'title' 	=> 'string NOT NULL',
			'pic'		=> 'varchar(100)',
			'year' 		=> 'varchar(10)',
			'created' 	=> 'integer'
		),
		'ENGINE=InnoDB CHARACTER SET utf8'
		);

	}

	public function down()
	{
		$this->dropTable( $this->table );
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
