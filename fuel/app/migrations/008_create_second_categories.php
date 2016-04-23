<?php

namespace Fuel\Migrations;

class Create_second_categories
{
	public function up()
	{
		\DBUtil::create_table('second_categories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'second_category_name' => array('constraint' => 255, 'type' => 'varchar', '0' => true),
			'third_category_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		    'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		/*
		 * third_categoriesをJOIN
		 */
		\DBUtil::add_foreign_key('second_categories', [
		        'constraint' => 'index_second_categories_to_third_categories',
		        'key' => 'third_category_id',
		        'reference' => [
		                'table' => 'third_categories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
	}

	public function down()
	{
		\DBUtil::drop_table('second_categories');
	}
}