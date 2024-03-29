<?php

declare(strict_types=1);

namespace Marktic\Promotion\Utility;

use Marktic\Promotion\PromotionServiceProvider;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class PackageConfig.
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;

    protected $name = PromotionServiceProvider::NAME;

    public static function configPath(): string
    {
        return __DIR__ . '/../../config/mkt_promotion.php';
    }

    /**
     * @param string|null $default
     */
    public static function tableName(string $name, string|null $default = null)
    {
        return static::instance()->get('tables.' . $name, $default);
    }

    /**
     * @param string|null $default
     *
     * @psalm-param 'EUR'|null $default
     */
    public static function defaultCurrencyCode(string|null $default = null)
    {
        return static::instance()->get('currencies.default', $default);
    }

    public static function rulesCondition($default = [])
    {
        return static::instance()->get('rules.conditions', $default);
    }

    /**
     * @throws \Exception
     */
    public static function databaseConnection(): ?string
    {
        return (string) static::instance()->get('database.connection');
    }

    public static function shouldRunMigrations(): bool
    {
        return false !== static::instance()->get('database.migrations', false);
    }
}
