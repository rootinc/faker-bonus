<?php

namespace Rootinc\FakerBonus\Provider;

use Faker\Provider\Base;

class Hashtag extends Base
{
    public function hashtag(): string
    {
        $phrase = ucwords($this->generator->catchPhrase);

        $tag = preg_replace('/[\W]/u', '', $phrase);

        $hashtag = "#{$tag}";

        return $hashtag;
    }
}