<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasConfiguration;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;

interface HasConfigurationInterface
{
    public function getConfiguration(): ModelConfiguration;
}