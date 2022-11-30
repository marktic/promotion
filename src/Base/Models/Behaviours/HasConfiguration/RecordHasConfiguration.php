<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasConfiguration;

use ByTIC\DataObjects\Casts\Metadata\AsMetadataObject;
use Marktic\Promotion\Base\Configurations\ModelConfiguration;

trait RecordHasConfiguration
{
    public function getConfiguration(): ModelConfiguration
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

    protected function registerCastConfiguration()
    {
        $this->casts = array_merge($this->casts, [
            'configuration' => AsMetadataObject::class . ':json,' . ModelConfiguration::class,
        ]);
    }
}
