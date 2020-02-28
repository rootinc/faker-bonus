<?php

namespace Rootinc\FakerBonus\Provider;

use Faker\Generator;
use Faker\Provider\Base;

class Hashtag extends Base
{
    protected $generator;
    protected $phrase;
    private $modifiers = [
        'none',
        'capword',
        'capletter',
    ];
    private $glues = [
        '',
        '_',
    ];

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
        $this->phrase = $this->generator->bs;

        parent::__construct($generator);
    }

    public function hashtag($include_tag = true): string
    {
        $tag = $this->build();

        $hashtag = !$include_tag ?: "#{$tag}";

        return $hashtag;
    }

    protected function build(): string
    {
        // Get set of words
        $words = explode(' ', $this->phrase);
        // Grab random modifier to affect each word
        $modifier = $this->modifiers[array_rand($this->modifiers)];
        // Grab random glue to implode words
        $glue = $this->glues[array_rand($this->glues)];

        //
        $modified_words = array_map(function($word) use($modifier){
            // Remove any non-alphanumeric & underscores
            $clean_word = preg_replace('/[\W]/u', '', $word);
            $clean_word = $this->modify($modifier, $clean_word);

            return $clean_word;
        }, $words);

        $tag = implode($glue, $modified_words);

        return $tag;
    }

    private function modify($modifier, $string): string
    {
        switch ($modifier) {
            case 'capword':
                $string = strtoupper($string);
                break;
            case 'capletter':
                $string = ucfirst($string);
                break;
            default:
                break;
        }

        return $string;
    }

}