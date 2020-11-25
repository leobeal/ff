<?php

namespace MetroMarkets\FFBundle\Providers;

use ConfigCat\Cache\ConfigCache;
use ConfigCat\ConfigCatClient;
use ConfigCat\User;
use MetroMarkets\FFBundle\Contract\ProviderInterface;
use Psr\Log\LoggerInterface;

class ConfigCatProvider implements ProviderInterface
{
    /** @var ConfigCatClient */
    private $client;

    public function __construct(string $sdkKey, ConfigCache $cache = null, int $cacheTTL = 60, LoggerInterface $logger = null)
    {
        $options = [];

        if ($cache) {
            $options['cache'] = $cache;
            $options['cache-refresh-interval'] = $cacheTTL;
        }

        if ($logger) {
            $options['logger'] = $logger;
        }

        $this->client = new ConfigCatClient($sdkKey, $options);
    }


    public function isEnabled(string $key, string $identifier = null): bool
    {
        $user = null;

        if ($identifier) {
            $user = new User($identifier);
        }

        return $this->client->getValue($key, false, $user);
    }
}