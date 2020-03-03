<?php

namespace Rootinc\Tests\FakerBonus\Provider;

use Rootinc\Tests\FakerBonus\TestCase;

class TweetTextTest extends TestCase
{
    /**
     * @test Formatter is valid with "at" option = true (default)
     */
    public function valid()
    {
        $tweet_text = $this->faker->tweetText;
        $tweet_text_set = explode(' ', $tweet_text);
        $this->assertGreaterThan(1, count($tweet_text_set));
    }

}