<?php

namespace Rootinc\FakerBonus;

use Faker\Generator;
use Rootinc\FakerBonus\Provider;

class ProviderCollectionHelper
{
    public static function addAllProvidersTo(Generator $faker)
    {
        $faker->addProvider(new Provider\Hashtag($faker));
        $faker->addProvider(new Provider\Mention($faker));
        $faker->addProvider(new Provider\TweetText($faker));
    }
}
