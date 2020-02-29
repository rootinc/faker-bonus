<?php

namespace Rootinc\Tests\FakerBonus\Provider;

use Rootinc\Tests\FakerBonus\TestCase;

class HashtagTest extends TestCase
{
    /**
     * @test Formatter is valid with hashtag option = true (default)
     */
    public function valid_with_hashtag()
    {
        $this->assertRegExp('/\#[\w]/', $this->faker->hashtag);
    }

    /**
     * @test Formatter is valid with hashtag option = false
     */
    public function valid_without_hashtag()
    {
        $this->assertRegExp('/[\w]/', $this->faker->hashtag(false));
    }
}