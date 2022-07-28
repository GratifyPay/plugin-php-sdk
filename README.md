# Build

- commit and push to origin
- create new github release, give it an incremented version

# Usage

Need to add to composer.json the repository:

```shell
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GratifyPay/plugin-php-sdk.git"
    }
  ]
```

after that execute next command:

```shell
composer require gratifypay/gratify-php-sdk:^1.0
```

# Tests

```shell
  MERCHANT_ID="merchant_...." SECRET_KEY="gpKey_..." ./vendor/bin/phpunit tests
```
