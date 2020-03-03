<?php

namespace Rootinc\FakerBonus\Provider;

use Faker\Generator;
use Faker\Provider\Base;

class TweetText extends Base
{
    protected $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;

        parent::__construct($generator);
    }

    /**
     * "Bootstrap" method for Faker formatter.
     *
     * @param boolean $include_emoji
     * @return string
     */
    public function tweetText($include_emoji = false): string
    {
        $tweet_text = $this->build($include_emoji);

        return $tweet_text;
    }

    /**
     * Build a valid tweet "phrase"
     *
     * @param boolean $include_emoji
     * @return string
     */
    protected function build($include_emoji): string
    {
        // Add whitespace only when we give variables values
        $sentences = $this->generator->sentences(3, true) . ' ';
        $mentions = $this->generator->mention . ' ';
        $hashtags = $this->generator->hashtag . ' ';
        $emoji = $include_emoji ? $this->generator->emoji . ' ' : '';

        $tweet_text = "{$mentions}{$sentences}{$emoji}{$hashtags}";

        return $tweet_text;
    }

}