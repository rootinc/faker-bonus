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
        'underscore',
        'capword',
        'capletter',
        'number'
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
        $word_count = count($words);
        // Clean
        $modified_words = array_map(function($i, $word) use($word_count){
            $last_word = $i === $word_count - 1;
            // Remove any non-alphanumeric & underscores
            $clean_word = preg_replace('/[\W]/u', '', $word);
            if(!$last_word) {
                $modifier = $this->modifiers[array_rand($this->modifiers)];
                $clean_word = $this->modify($modifier, $clean_word);
            }

            return $clean_word;
        }, array_keys($words), $words);

        $tag = implode('', $modified_words);
        var_dump($tag);

        return $tag;
    }

    private function modify($modifier, $string): string
    {
        switch ($modifier) {
            case 'underscore':
                $string = "{$string}_";
                break;
            case 'capword':
                $string = strtoupper($string);
                break;
            case 'capletter':
                $string = ucfirst($string);
                break;
            case 'number':
                $number = rand(0,9);
                $string = "{$string}{$number}";
                break;
            default:
                break;
        }

        return $string;
    }

}