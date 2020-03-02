## General Installation

We can add new Providers directly to the Faker instance before we use it:
### Add All Providers

```
$faker = Faker\Factory::create();
ProviderCollectionHelper::addAllProvidersTo($faker);
// Use Faker
$faker->hashtag
```

### Add Specific Provider/s
```
$faker = Faker\Factory::create();
$faker->addProvider(new Provider\Hashtag($faker));
...
// Add more Providers 
...
// Use Faker
$faker->hashtag
```

## Laravel Installation

We can have Providers/Formatters added to all instances of Faker\Generator by updating our `AppServiceProvier` as follows:

### Add All Providers

app/Providers/AppServiceProvider.php
```
use Faker\Generator;
...

public function register() {
  ...
  // Whenever Faker\Generator is called, substitute the return value of this block
  $this->app->extend(Generator::class, function ($generator) {
      // Add Providers to the Faker\Generator class
      ProviderCollectionHelper::addAllProvidersTo($generator);
      // Return modified Faker\Generator
      return $generator;
  });
  ...
}
```

## Usage

### Hashtag

### Mention
