<?php

namespace Rootinc\Tests\FakerBonus\Provider;

use Rootinc\Tests\FakerBonus\TestCase;

class MentionTest extends TestCase
{
    /**
     * @test Formatter is valid with "at" option = true (default)
     */
    public function valid_with_at()
    {
        $mention = $this->faker->mention;
        $this->assertRegExp($this->mentionRegex(), $mention);
    }

    /**
     * @test Formatter is valid with "at" option = false
     */
    public function valid_without_at()
    {
        $mention = $this->faker->mention(false);
        $this->assertNotRegExp($this->mentionRegex(), $mention);
    }

}