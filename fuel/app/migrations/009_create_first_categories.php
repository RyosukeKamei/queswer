<?php

namespace Fuel\Migrations;

class Create_first_categories
{
	public function up()
	{
		\DBUtil::create_table('first_categories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'first_category_name' => array('constraint' => 255, 'type' => 'varchar', '0' => true),
			'second_category_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		    'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		/*
		 * second_categoriesをJOIN
		 */
		\DBUtil::add_foreign_key('first_categories', [
		        'constraint' => 'index_first_categories_to_second_categories',
		        'key' => 'second_category_id',
		        'reference' => [
		                'table' => 'second_categories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
		/*
		 * questions から first_categoriesをJOIN
		 */
		\DBUtil::add_foreign_key('questions', [
		        'constraint' => 'index_questions_to_first_categories',
		        'key' => 'first_category_id',
		        'reference' => [
		                'table' => 'first_categories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
	}

	public function down()
	{
		\DBUtil::drop_table('first_categories');
	}
}