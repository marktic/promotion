<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Traits;

use Marktic\Promotion\Utility\PackageConfig;
use Nip\Database\Connections\Connection;

/**
 * Trait HasDatabaseConnectionTrait.
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
