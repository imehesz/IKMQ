<?php

class m110330_235808_quotes_table extends CDbMigration
{
	public $table = 'quotes';

	public function up()
	{
		$this->createTable( $this->table, array(
			'id' 		=> 'pk',
			'movie_id' 	=> 'int not null',
			'quote' 	=> 'text',
			'level'		=> 'tinyint',
			'created' 	=> 'integer'
		),
		'ENGINE=InnoDB CHARACTER SET utf8'
		);

		$this->createIndex( 'fk_movie_id', $this->table, 'movie_id' );
		$this->addForeignKey('fk_movie_id', $this->table, 'movie_id', 'movies', 'id', 'NO ACTION', 'NO ACTION');
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
