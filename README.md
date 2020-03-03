# faker-bonus

[![Codeship Status for rootinc/faker-bonus](https://app.codeship.com/projects/3d1428a0-3f07-0138-f2a1-0a35e539f0bc/status?branch=master)](https://app.codeship.com/projects/387568)

A handy set of extra Faker Formatters/Providers for [fzaninotto/faker](https://github.com/fzaninotto/faker) built to integrate with Laravel or
any PHP project that uses Faker.

## Contents
1. [Installation](#installation) 
1. [Usage](#basic-usage) 
    1. [Basic Usage](#basic-usage) 
    1. [Laravel Installation](#laravel-usage) 
1. [Testing](#testing)
1. [Acknowledgements](#acknowledgement)

## Installation

```bash
composer install rootinc/faker-bonus --dev
```

## Usage

We can add new Providers directly to the Faker instance before we use it:
### Basic Usage

```php
<?php
$faker = Faker\Factory::create();
ProviderCollectionHelper::addAllProvidersTo($faker);
// Use Faker
$faker->hashtag;
```

#### Specific Provider/s
```php
<?php
$faker = Faker\Factory::create();
$faker->addProvider(new Provider\Hashtag($faker));
//...
// Add more Providers 
//...
// Use Faker
$faker->hashtag;
```

### Laravel Usage

We can have Providers/Formatters added to all instances of `Faker\Generator` by updating our `AppServiceProvier` as follows:

#### All Providers

app/Providers/AppServiceProvider.php
```php
<?php

use Faker\Generator;

public function register() {
  //...
  // Whenever Faker\Generator is called, substitute the return value of this block
  $this->app->extend(Generator::class, function ($generator) {
      // Add Providers to the Faker\Generator class
      ProviderCollectionHelper::addAllProvidersTo($generator);
      // Return modified Faker\Generator
      return $generator;
  });
  //...
}
```

## Formatters

### Hashtag

Builds off `$faker->bs` to build some fun hashtags like: `#FacilitateScalableSynergies` `#EXPLOIT_CUTTINGEDGE_EYEBALLS` `#disintermediate_onetoone_markets`.

#### Definition
```php
$faker->hashtag($includeTag = true)
```
#### Usage
```php
$faker->hashtag // '#this_is_fun'
$faker->hashtag(false) // 'this_is_fun'

```

### Mention

Builds off `$faker->userName` to create handle-ish mentions like: `@BSCHADEN` `@Irolfson` `@bartoletti.barbara`

#### Definition
```php
$faker->mention($includeAt = true)
```
#### Usage
```php
$faker->mention // '@SomeBody'
$faker->mention(false) // 'SomeBody'

```

### Tweet Text

Create tweet-like text like: `@BSCHADEN The a my were anchors for consider that one man perfectly. 😀 #EXPLOIT_CUTTINGEDGE_EYEBALLS`

#### Definition
```php
$faker->tweetText($nbParagraphs = 1, $includeEmoji = true)
```
#### Usage
```php
$faker->tweetText // '@BSCHADEN The a my were anchors for consider that one man perfectly. 😀 #EXPLOIT_CUTTINGEDGE_EYEBALLS'
$faker->tweetText(2) // @BSCHADEN The a my were anchors for consider that one man perfectly.\n Created, rung and over flows let four it lane.😀 #EXPLOIT_CUTTINGEDGE_EYEBALLS
$faker->tweetText(3, false) // @BSCHADEN The a my were anchors for consider that one man perfectly.\n\n Created, rung and over flows let four it lane.\n\n Created, rung and over flows let four it lane. #EXPLOIT_CUTTINGEDGE_EYEBALLS
```

## Testing

```bash
composer install
vendor/bin/phpunit
```

## Acknowledgements

- Influenced by: [mbezhanov/faker-provider-collection](https://github.com/mbezhanov/faker-provider-collection)
