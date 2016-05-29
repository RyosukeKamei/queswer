<?php

namespace Fuel\Migrations;

class Create_secondcategories
{
	public function up()
	{
		\DBUtil::create_table('secondcategories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'thirdcategory_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'second_category_name' => array('constraint' => 255, 'type' => 'varchar'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		/*
		 * thirdcategoriesをJOIN
		 */
		\DBUtil::add_foreign_key('secondcategories', [
		        'constraint' => 'index_secondcategories_to_thirdcategories',
		        'key' => 'thirdcategory_id',
		        'reference' => [
		                'table' => 'thirdcategories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);		
	}

	public function down()
	{
		\DBUtil::drop_table('secondcategories');
	}
}