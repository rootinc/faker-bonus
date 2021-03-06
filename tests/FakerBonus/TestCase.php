<?php

namespace Rootinc\Tests\FakerBonus;

use Rootinc\FakerBonus\ProviderCollectionHelper;
use Faker\Factory;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        ProviderCollectionHelper::addAllProvidersTo($this->faker);
    }

    protected function hashtagRegex()
    {
        return '/\#[\w]{3,}/';
    }

    protected function mentionRegex()
    {
        return '/\@[\w\.]{3,}/';
    }

    protected function emojiRegex()
    {
        return '/[\p{So}]/u';
    }
}