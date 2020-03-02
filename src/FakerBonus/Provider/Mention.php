<?php

namespace Rootinc\FakerBonus\Provider;

use Faker\Generator;
use Faker\Provider\Base;

class Mention extends Base
{
    protected $generator;
    protected $user_name;

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
        '.',
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
     * @param bool $include_at
     * @return string
     */
    public function mention($include_at = true): string
    {
        $this->user_name = $this->generator->userName;

        $mention = $this->build();

        // Add "@" if needed
        $mention = $include_at
            ? "@{$mention}"
            : $mention;

        return $mention;
    }

    /**
     * Build a valid hashtag "phrase"
     *
     * @return string
     */
    protected function build(): string
    {
        // Get set of username pieces
        $mention_pieces = explode('.', $this->user_name);

        // Grab random modifier to affect each piece
        $modifier = $this->modifiers[array_rand($this->modifiers)];

        // Grab random glue to implode pieces
        $glue = $this->glues[array_rand($this->glues)];

        // Clean and run modifier on all pieces
        $modified_pieces = array_map(function($piece) use($modifier){
            // Remove any non-alphanumeric & underscores & dots
            $clean_piece = preg_replace('/[\W\.]/u', '', $piece);
            $clean_piece = $this->modify($modifier, $clean_piece);

            return $clean_piece;
        }, $mention_pieces);

        $mention = $this->glue($glue, $modified_pieces);

        return $mention;
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