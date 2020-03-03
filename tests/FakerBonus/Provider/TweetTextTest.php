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
        $tweet_text = $this->faker->tweetText();
        $paragraph_set = preg_split('/[\r\n|\r|\n]+\s/', $tweet_text);
        $text_set = explode(' ', $tweet_text);

        $this->assertGreaterThan(3, count($text_set));

        $this->assertCount(1, $paragraph_set);

        // Has hashtag
        $this->assertRegExp($this->hashtagRegex(), $tweet_text);

        // Has mention
        $this->assertRegExp($this->mentionRegex(), $tweet_text);

        // Has emoji
        $result = preg_match($this->emojiRegex(), $tweet_text);
        $this->assertTrue(!!$result);
    }

    /**
     * @test
     */
    public function valid_with_four_paragraphs()
    {
        $tweet_text = $this->faker->tweetText(4);
        $paragraph_set = preg_split('/[\r\n|\r|\n]+\s/', $tweet_text);

        $this->assertCount(4, $paragraph_set);

        // Has hashtag
        $this->assertRegExp($this->hashtagRegex(), $tweet_text);

        // Has mention
        $this->assertRegExp($this->mentionRegex(), $tweet_text);

        // Has emoji
        $result = preg_match($this->emojiRegex(), $tweet_text);
        $this->assertTrue(!!$result);
    }

    /**
     * @test Formatter is valid with "at" option = true (default)
     */
    public function valid_without_emoji()
    {
        $tweet_text = $this->faker->tweetText(1, false);
        $paragraph_set = preg_split('/[\r\n|\r|\n]+\s/', $tweet_text);

        $this->assertCount(1, $paragraph_set);

        // Has hashtag
        $this->assertRegExp($this->hashtagRegex(), $tweet_text);

        // Has mention
        $this->assertRegExp($this->mentionRegex(), $tweet_text);

        // Has emoji
        $result = preg_match($this->emojiRegex(), $tweet_text);
        $this->assertFalse(!!$result);
    }

}