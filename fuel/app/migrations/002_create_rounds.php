<?php

namespace Fuel\Migrations;

class Create_rounds
{
	public function up()
	{
		\DBUtil::create_table('rounds', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'round_name' => array('constraint' => 255, 'type' => 'varchar'),
			'examination_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
        
        /*
         * examination（試験区分をJOIN）
         */
        \DBUtil::add_foreign_key('rounds', [
              'constraint' => 'index_rounds_to_examination',
            'key' => 'examination_id',
            'reference' => [
                'table' => 'examinations',
                'column' => 'id',
            ],
            'on_update' => 'CASCADE',
            'on_delete' => 'CASCADE'
        ]);	
	}

	public function down()
	{
		\DBUtil::drop_table('rounds');
	}
}