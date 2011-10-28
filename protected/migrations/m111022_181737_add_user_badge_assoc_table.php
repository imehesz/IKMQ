<?php

class m111022_181737_add_user_badge_assoc_table extends CDbMigration
{
	public $table = 'assoc_user_badge';

	public function up()
	{
		$this->createTable(
			$this->table,
			array(
				'user_id'	=> 'int',
				'badge_id'	=> 'int',
				'created'	=> 'int',
			),
			'ENGINE=InnoDB'
		);

		$this->createIndex( 'fk_user_badge_user_id', $this->table, 'user_id' );
		$this->addForeignKey('fk_user_badge_user_id', $this->table, 'user_id', 'anonymous_user', 'id', 'NO ACTION', 'NO ACTION');

		$this->createIndex( 'fk_user_badge_badge_id', $this->table, 'badge_id' );
		$this->addForeignKey('fk_user_badge_badge_id', $this->table, 'badge_id', 'badge', 'id', 'NO ACTION', 'NO ACTION');
	}

	public function down()
	{
		$this->dropTable( $this->table );
	}
}
