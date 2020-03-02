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
        $hashtag = $this->faker->hashtag;
        $this->assertRegExp('/\#[\w]/', $hashtag);
    }

    /**
     * @test Formatter is valid with hashtag option = false
     */
    public function valid_without_hashtag()
    {
        $hashtag = $this->faker->hashtag(false);
        $this->assertRegExp('/[\w]/', $hashtag);
    }

}