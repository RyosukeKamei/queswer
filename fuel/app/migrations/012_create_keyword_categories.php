<?php

namespace Fuel\Migrations;

class Create_keyword_categories
{
	public function up()
	{
		\DBUtil::create_table('keyword_categories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'first_category_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'keyword_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
		    'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
		/*
		 * first_categoriesをJOIN
		 */
		\DBUtil::add_foreign_key('keyword_categories', [
		        'constraint' => 'index_keyword_categories_to_first_categories',
		        'key' => 'first_category_id',
		        'reference' => [
		                'table' => 'first_categories',
		                'column' => 'id',
		        ],
		        'on_update' => 'CASCADE',
		        'on_delete' => 'CASCADE'
		]);
		/*
		 * keywordsをJOIN
		 */
		\DBUtil::add_foreign_key('keyword_categories', [
		        'constraint' => 'index_keyword_categories_to_second_categories',
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
		\DBUtil::drop_table('keyword_categories');
	}
}