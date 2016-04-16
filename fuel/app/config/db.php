<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
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
