<?php

namespace Marktic\Promotion\Utility;

use Exception;
use Marktic\Promotion\PromotionServiceProvider;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class PackageConfig
 * @package ByTIC\PackageBase\Utility
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;

    protected $name = PromotionServiceProvider::NAME;

    public static function configPath(): string
    {
        return __DIR__ . '/../../config/mkt_promotion.php';
    }

    public static function tableName($name, $default = null)
    {
        return static::instance()->get('tables.' . $name, $default);
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function databaseConnection(): ?string
    {
        return (string)static::instance()->get('database.connection');
    }

    public static function shouldRunMigrations(): bool
    {
        return static::instance()->get('database.migrations', false) !== false;
    }
}
