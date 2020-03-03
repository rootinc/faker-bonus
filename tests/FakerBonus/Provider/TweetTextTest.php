<?php

namespace Rootinc\Tests\FakerBonus\Provider;

use Rootinc\Tests\FakerBonus\TestCase;

class TweetTextTest extends TestCase
{
    /**
     * @test Formatter is valid with "at" option = true (default)
     */
    public function valid_standard_call()
    {
        $tweet_text = $this->faker->tweetText;
        $tweet_text_set = explode(' ', $tweet_text);

        $this->assertGreaterThan(1, count($tweet_text_set));
        // Has hashtag
        $this->assertRegExp('/\#[\w]{3,}/', $tweet_text);
        // Has mention
        $this->assertRegExp('/\@[\w]{3,}/', $tweet_text);
    }

}