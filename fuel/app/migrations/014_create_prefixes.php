<?php

namespace Fuel\Migrations;

class Create_prefixes
{
	public function up()
	{
		\DBUtil::create_table('prefixes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'prefix_name' => array('constraint' => 255, 'type' => 'varchar', '0' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		    'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		/*
		 * questions から roundsをJOIN
		 */
		\DBUtil::add_foreign_key('questions', [
		        'constraint' => 'index_questions_to_prefixes',
		        'key' => 'prefix_id',
		        'reference' => [
		                'table' => 'prefixes',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);	}

	public function down()
	{
		\DBUtil::drop_table('prefixes');
	}
}