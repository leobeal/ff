<?php

namespace MetroMarkets\FFBundle\Providers;

use MetroMarkets\FFBundle\Contract\ProviderInterface;

class FalseProvider implements ProviderInterface
{
    public function isEnabled(string $key, string $identifier = null): bool
    {
        return false;
    }
}