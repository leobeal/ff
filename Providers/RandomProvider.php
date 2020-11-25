<?php

namespace MetroMarkets\FFBundle\Providers;

use MetroMarkets\FFBundle\Contract\ProviderInterface;

class RandomProvider implements ProviderInterface
{
    public function isEnabled(string $key, string $identifier = null): bool
    {
        return (bool) rand(0, 1);
    }
}