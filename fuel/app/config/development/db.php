<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			//-- Dockerを利用する場合hostは"192.168.99.100"
			//-- dbnameに作成したデータベース名を記載
			'dsn'        => 'mysql:host=192.168.99.100;dbname=queswer',
			//-- MySQLに設定したユーザ名を記載
			'username'   => 'system',
			//-- MySQLに設定したパスワードを記載
			'password'   => 'oVzj5DtPmBe5epTR',
		),
	),
);
