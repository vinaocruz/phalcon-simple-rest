<?php

$config['db'] = require_once __DIR__ . '/database.php';
$config['api.timezone'] = 'America/Bahia';

date_default_timezone_set($config['api.timezone']);
