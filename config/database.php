<?php

	//define config database
	return [

		'default' => 'mysql',

		'mysql' => [
			"host"     => getenv(DB_HOST),
			"username" => getenv(DB_USERNAME),
			"password" => getenv(DB_PASSWORD),
			"dbname"   => getenv(DB_DATABASE),
		],

		//Example setting for pgsql
		/*'pgsql' => [
			'driver' => 'pgsql',
			'host' => env('DB_HOST', 'developer-pgsql.conder.intranet'),
			'port' => env('DB_PORT', '5432'),
			'database' => env('DB_DATABASE', 'polo'),
			'username' => env('DB_USERNAME', 'seden'),
			'password' => env('DB_PASSWORD', 's3d3n@c0nd3r'),
			'charset' => 'utf8',
			'prefix' => '',
			'schema' => 'public',
		],*/

	];
