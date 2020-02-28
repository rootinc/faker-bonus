<?php

namespace Rootinc\Tests\FakerBonus\Provider;

class HashtagTest extends TestCase
{
    /**
     * @test
     */
    public function testHashtag()
    {
        $this->assertRegExp('/\#[\w]/', $this->faker->hashtag);
    }
}