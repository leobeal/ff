
[![Build Status](https://travis-ci.com/leobeal/ff.svg?branch=main)](https://travis-ci.com/leobeal/ff)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/leobeal/ff/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/leobeal/ff/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/leobeal/ff/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/leobeal/ff/?branch=main)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Metro Markets FF
===============

Metro Markets FF is a Feature Flag Symfony Bundle. It easily allows you to configure and use your favorite feature flag provider.

Installation
----------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require metro-markets/ff-bundle
```

### Step 2: Enable the Bundle
(Please skip this step if you are using Symfony Flex)
Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    MetroMarkets\FFBundle\MetroMarketsFFBundle::class => ['all' => true],
];
```

### Step 3: Create the configuration

```yaml
# config/packages/metro_markets_ff.yaml

config:
metro_markets:
    provider: configcat
    configcat:
        sdk_key: xxxxx # Get it from ConfigCat Dashboard.

```

How to use it
---------------

After the installation is done you can simply inject the service anywhere and use it as follows:

```php
use MetroMarkets\FFBundle\FeatureFlagService;

class AnyService
{
    /** @var FeatureFlagService */
    private $featureFlagService;

    public function __construct(FeatureFlagService $featureFlagService)
    {
        $this->featureFlagService = $featureFlagService;
    }


    protected function someMethod()
    {
        $isEnabled = $this->featureFlagService->isEnabled('that_cool_new_feature');
        
        if ($isEnabled){
            doTheNewStuff();
        } else{
            keepItTheOld();
        }
    }   
}
```

About providers
---------------


License
-------
This package is open-sourced software licensed under the MIT license. Please for more info refer to the [license](LICENSE)