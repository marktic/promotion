<?php

namespace Marktic\Promotion\Models\AbstractModels;

use Marktic\Promotion\Utility\PackageConfig;
use Nip\Database\Connections\Connection;

/**
 * Trait HasDatabaseConnectionTrait
 * @package Marktic\Promotion\Models\AbstractModels
 */
trait HasDatabaseConnectionTrait
{

    /**
     * @return Connection
     */
    protected function newDbConnection()
    {
        return app('db')->connection(PackageConfig::databaseConnection());
    }
}

