<?php

namespace Fuel\Migrations;

class Create_firstcategories
{
	public function up()
	{
		\DBUtil::create_table('firstcategories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'secondcategory_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'first_category_name' => array('constraint' => 255, 'type' => 'varchar'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		/*
		 * secondcategoriesをJOIN
		 */
		\DBUtil::add_foreign_key('firstcategories', [
		        'constraint' => 'index_firstcategories_to_secondcategories',
		        'key' => 'secondcategory_id',
		        'reference' => [
		                'table' => 'secondcategories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
		/*
		 * questions から firstcategoriesをJOIN
		*/
		\DBUtil::add_foreign_key('questions', [
		        'constraint' => 'index_questions_to_firstcategories',
		        'key' => 'firstcategory_id',
		        'reference' => [
		                'table' => 'firstcategories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
		
	}

	public function down()
	{
		\DBUtil::drop_table('firstcategories');
	}
}