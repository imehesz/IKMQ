<?php

class m110410_014725_create_anonymous_user_table extends CDbMigration
{
    public $table = 'anonymous_user';

	public function up()
	{
		$this->createTable( $this->table, array(
			'id' 		=> 'pk',
			'name' 	    => 'string NOT NULL',
			'session_id'=> 'varchar(100)',
			'level' 	=> 'integer',
			'score' 	=> 'integer',
			'created' 	=> 'integer',
			'updated' 	=> 'integer'
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8' );
	}

	public function down()
	{
        $this->dropTable( $this->table );
	}
}
