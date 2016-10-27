<?php

require_once __DIR__ . '/../vendor/autoload.php';

//require_once __DIR__ . '/../config/main.php';

require __DIR__ . '/../bootstrap/app.php';

$app->get(
    "/",
    function () {
		$pdo = new \PDO(
		    'mysql:host=db;dbname=demoDb',
		    'demoUser',
		    'demoPass'
		);

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$consulta = $pdo->query('select * from users');

		$linha= $consulta->fetchAll(PDO::FETCH_ASSOC);

    	echo json_encode($linha);
    }
);

//require_once __DIR__ . '/../src/middleware.php';
//require_once __DIR__ . '/../src/routes.php';

$app->handle();
