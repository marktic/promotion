<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasConfiguration;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;

interface HasConfigurationInterface
{
    public function getConfiguration(): ModelConfiguration;
}
