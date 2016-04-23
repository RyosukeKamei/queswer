<?php

namespace Fuel\Migrations;

class Create_third_categories
{
	public function up()
	{
		\DBUtil::create_table('third_categories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'third_category_name' => array('constraint' => 255, 'type' => 'varchar', '0' => true),
			'top_category_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		    'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true), 
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		
		/*
		 * top_categoriesをJOIN
		 */
		\DBUtil::add_foreign_key('third_categories', [
		        'constraint' => 'index_third_categories_to_top_categories',
		        'key' => 'top_category_id',
		        'reference' => [
		                'table' => 'top_categories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
	}

	public function down()
	{
		\DBUtil::drop_table('third_categories');
	}
}