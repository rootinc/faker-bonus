## Contents
1. [Installation](#installation) 
1. [Usage](#basic-usage) 
    1. [Basic Usage](#basic-usage) 
    1. [Laravel Installation](#laravel-usage) 

## Installation

```bash
composer install rootinc/faker-bonus
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

We can have Providers/Formatters added to all instances of Faker\Generator by updating our `AppServiceProvier` as follows:

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

```php
$faker->hashtag // '#this_is_fun'
$faker->hashtag(false) // 'this_is_fun'

```

### Mention

Builds off `$faker->userName` to create handle-ish mentions like: `@BSCHADEN` `@Irolfson` `@bartoletti.barbara`

```php
$faker->mention // '@SomeBody'
$faker->mention(false) // 'SomeBody'

```
