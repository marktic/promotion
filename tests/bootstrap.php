<?php

declare(strict_types=1);

use Mockery\Mock;
use Nip\Cache\Stores\Repository;
use Nip\Config\Config;
use Nip\Container\Container;
use Nip\Database\Connections\Connection;
use Nip\Database\DatabaseManager;
use Nip\Database\Manager;
use Nip\Inflector\Inflector;
use \Nip\Http\Request;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

define('PROJECT_BASE_PATH', __DIR__ . '/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__ . \DIRECTORY_SEPARATOR . 'fixtures');

$container = new Container();
$container->set('inflector', Inflector::instance());
$container->set('config', new Config([], true));
$container->set('request', new Request());

$adapter = new ArrayAdapter( 600);
$store = new Repository($adapter);
$store->clear();
$container->set('cache.store', $store);
Container::setInstance($container);


/** @var Mock|Connection $connection */
$connection = Mockery::mock(Connection::class)->makePartial();
$connection->setAdapter($adapter);
$connection->setDatabase('42km_ro_register');

$metadata = Mockery::mock(DatabaseManager::class)->makePartial();
$metadata->shouldReceive('describeTable')->andReturn(['fields' => []]);
$connection->shouldReceive('getMetadata')->andReturn($metadata);

$container->set('db.connection', $connection);

require dirname(__DIR__) . '/vendor/autoload.php';
