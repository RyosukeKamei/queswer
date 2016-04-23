<?php

namespace Fuel\Migrations;

class Create_organizations
{
	public function up()
	{
		\DBUtil::create_table('organizations', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'organization_name' => array('constraint' => 255, 'type' => 'varchar', '0' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		    'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		/*
		 * top_categories と organicationsをJOIN
		 * 新しくカラムを追加してJOINする
		 */
		\DBUtil::add_foreign_key('top_categories', [
		        'constraint' => 'index_top_categories_to_organications',
		        'key' => 'organization_id',
		        'reference' => [
		                'table' => 'organizations',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
	}

	public function down()
	{
		\DBUtil::drop_table('organizations');
	}
}