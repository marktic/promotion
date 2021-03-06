<?php

namespace Marktic\Promotion\Base\Models\Traits;

use ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
use Nip\I18n\Translatable\HasTranslations;
use Nip\Records\Filters\Records\HasFiltersRecordsTrait;

/**
 * Trait CommonRecordsTrait
 * @package Marktic\Promotion\Models\AbstractModels
 */
trait CommonRecordsTrait
{
    use HasTranslations;
    use HasFormsRecordsTrait;
    use HasFiltersRecordsTrait;


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
        if (defined('static::CONTROLLER')) {
            return static::CONTROLLER;
        }

        return $this->getTable();
    }
}
