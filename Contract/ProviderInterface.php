<?php

namespace MetroMarkets\FFBundle\Contract;

interface ProviderInterface
{
    public function isEnabled(string $key, string $identifier = null): bool;
}
