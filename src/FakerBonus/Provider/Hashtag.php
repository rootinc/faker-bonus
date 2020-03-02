<?php

namespace Rootinc\FakerBonus\Provider;

use Faker\Generator;
use Faker\Provider\Base;

class Hashtag extends Base
{
    protected $generator;
    protected $phrase;

    /**
     * List of modifications that can run on word set
     * @var array
     */
    private $modifiers = [
        'none',
        'capword',
        'capletter',
        'lowerword',
    ];

    /**
     * List of ways we can combine word set
     * @var array
     */
    private $glues = [
        '',
        '_',
    ];

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;

        parent::__construct($generator);
    }

    /**
     * "Bootstrap" method for Faker formatter.
     *
     * @param bool $include_tag
     * @return string
     */
    public function hashtag($include_tag = true): string
    {
        $this->phrase = $this->generator->bs;

        $tag = $this->build();

        // Add "#" if needed
        $hashtag = $include_tag
            ? "#{$tag}"
            : $tag;

        return $hashtag;
    }

    /**
     * Build a valid hashtag "phrase"
     *
     * @return string
     */
    protected function build(): string
    {
        // Get set of words
        $words = explode(' ', $this->phrase);

        // Grab random modifier to affect each word
        $modifier = $this->modifiers[array_rand($this->modifiers)];

        // Grab random glue to implode words
        $glue = $this->glues[array_rand($this->glues)];

        // Clean and run modifier on all words
        $modified_words = array_map(function($word) use($modifier){
            // Remove any non-alphanumeric & underscores
            $clean_word = preg_replace('/[\W]/u', '', $word);
            $clean_word = $this->modify($modifier, $clean_word);

            return $clean_word;
        }, $words);

        $tag = $this->glue($glue, $modified_words);

        return $tag;
    }

    /**
     * Run a modification on a string
     *
     * @param $modifier
     * @param $string
     * @return string
     */
    protected function modify($modifier, $string): string
    {
        switch ($modifier) {
            case 'capword':
                $string = strtoupper($string);
                break;
            case 'capletter':
                $string = ucfirst($string);
                break;
            case 'lowerword':
                $string = strtolower($string);
                break;
            default:
                break;
        }

        return $string;
    }

    /**
     * Glue together a set of strings
     *
     * @param $glue
     * @param $words
     * @return string
     */
    protected function glue($glue, $words): string
    {
        return implode($glue, $words);
    }

}