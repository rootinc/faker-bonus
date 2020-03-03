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
     * @param integer $nbParagraphs
     * @param boolean $includeEmoji
     * @return string
     */
    public function tweetText($nbParagraphs = 1, $includeEmoji = true): string
    {
        $tweet_text = $this->build($nbParagraphs, $includeEmoji);

        return $tweet_text;
    }

    /**
     * Build a valid tweet "phrase"
     *
     * @param integer $nbParagraphs
     * @param boolean $includeEmoji
     * @return string
     */
    protected function build($nbParagraphs, $includeEmoji): string
    {
        // Create pieces
        $sentences = $this->generator->paragraphs($nbParagraphs, true);
        $mentions = $this->generator->mention;
        $emoji = $includeEmoji ? $this->generator->emoji : null;
        $hashtags = $this->generator->hashtag;

        // Filter out anything without a value
        $pieces = array_filter([
            $mentions,
            $sentences,
            $emoji,
            $hashtags
        ], function($piece){
            return !empty($piece);
        });

        $tweet_text = implode(' ', $pieces);

        return $tweet_text;
    }

}