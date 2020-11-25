<?php

namespace MetroMarkets\FFBundle;

use MetroMarkets\FFBundle\Contract\ProviderInterface;

final class FeatureFlagService
{
    /** @var ProviderInterface */
    private $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function isEnabled(string $key, $identifier = null): bool
    {
        return $this->provider->isEnabled($key, $identifier);
    }

    public function getProvider(): ProviderInterface
    {
        return $this->provider;
    }
}