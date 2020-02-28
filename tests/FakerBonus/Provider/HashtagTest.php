<?php

namespace Rootinc\Tests\FakerBonus\Provider;

use Rootinc\Tests\FakerBonus\TestCase;

class HashtagTest extends TestCase
{
    /**
     * @test
     */
    public function hashtag_is_valid()
    {
        $this->assertRegExp('/\#[\w]/', $this->faker->hashtag);
    }
}