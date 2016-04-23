<?php

namespace Fuel\Migrations;

class Create_admins
{
	public function up()
	{
		\DBUtil::create_table('admins', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 255, 'type' => 'varchar'),
			'password' => array('constraint' => 255, 'type' => 'varchar'),
			'examination_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		    'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		
		/*
		 * examination（問題をJOIN）
		 * 外部キーを貼るときに必要なindexは自動的に貼ってくれる？
		 */
		\DBUtil::add_foreign_key('admins', [
				'constraint' => 'index_admins_to_examination',
				'key' => 'examination_id',
				'reference' => [
						'table' => 'examinations',
						'column' => 'id',
				],
				'on_update' => 'CASCADE'
				, 'on_delete' => 'CASCADE'
		]);
	}

	public function down()
	{
		\DBUtil::drop_table('admins');
	}
}