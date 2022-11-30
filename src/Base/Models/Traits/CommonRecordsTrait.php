<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Traits;

use ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
use Nip\I18n\Translatable\HasTranslations;
use Nip\Records\Filters\Records\HasFiltersRecordsTrait;

/**
 * Trait CommonRecordsTrait.
 */
trait CommonRecordsTrait
{
    use HasFiltersRecordsTrait;
    use HasFormsRecordsTrait;
    use HasTranslations;

    /**
     * @return string
     */
    public function getTranslateRoot()
    {
        return $this->getController();
    }

    public function getRootNamespace()
    {
        return 'Marktic\Promotion\Models\\';
    }

    protected function generateController(): string
    {
        if (\defined('static::CONTROLLER')) {
            return static::CONTROLLER;
        }

        return $this->getTable();
    }
}
