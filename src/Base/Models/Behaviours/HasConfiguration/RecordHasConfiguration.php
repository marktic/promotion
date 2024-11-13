<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasConfiguration;

use ByTIC\DataObjects\Casts\Metadata\AsMetadataObject;
use ByTIC\DataObjects\Casts\Metadata\Metadata;
use Marktic\Promotion\Base\Configurations\ModelConfiguration;

trait RecordHasConfiguration
{
    public function getConfiguration(): Metadata
    {
        return $this->getPropertyValue('configuration');
    }

    /**
     * @param array|string $configuration
     */
    public function setConfiguration($configuration): void
    {
        if (\is_array($configuration)) {
            $configuration = json_encode($configuration);
        }
        $this->setPropertyValue('configuration', $configuration);
    }

    protected function registerCastConfiguration(): void
    {
        $this->casts = array_merge($this->casts, [
            'configuration' => AsMetadataObject::class . ':json,' . $this->castConfigurationClass(),
        ]);
    }

    protected function castConfigurationClass(): string
    {
        return ModelConfiguration::class;
    }
}
