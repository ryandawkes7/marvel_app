<?php

namespace App\Faker;

use Faker\Provider\Base;

class PropertyTitleProvider extends Base 
{
    protected static $names = [
        'Avengers',
        'Black Widow',
        'Deadpool',
        'Moon Knight',
        'Captain America',
        'She-Hulk',
        'Spider-Man',
    ];

    /**
     * Returns a random value from the $names array
     *
     * @return string
     */
    public function propertyTitle(): string
    {
        return static::randomElement(static::$names);
    }
}