<?php

namespace Fuel\Migrations;

class Create_keywordcategories
{
	public function up()
	{
		\DBUtil::create_table('keywordcategories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'firstcategory_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'keyword_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		
		/*
		 * firstcategoriesをJOIN
		 */
		\DBUtil::add_foreign_key('keywordcategories', [
		        'constraint' => 'index_keywordcategories_to_first_categories',
		        'key' => 'firstcategory_id',
		        'reference' => [
		                'table' => 'firstcategories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
		/*
		 * keywordsをJOIN
		*/
		\DBUtil::add_foreign_key('keywordcategories', [
		        'constraint' => 'index_keywordcategories_to_keywords',
		        'key' => 'keyword_id',
		        'reference' => [
		                'table' => 'keywords',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);		
	}

	public function down()
	{
		\DBUtil::drop_table('keywordcategories');
	}
}