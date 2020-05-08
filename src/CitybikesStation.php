<?php

namespace Astrotomic\CitybikesTile;

class CitybikesStation
{
    protected array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function name(): string
    {
        return $this->attributes['name'];
    }

    public function numberOfBikesAvailable(): int
    {
        return $this->attributes['free_bikes'];
    }

    public function displayClass(): string
    {
        if ($this->isEmpty()) {
            return 'line-through text-dimmed';
        }

        if ($this->isNearlyEmpty()) {
            return 'text-warning';
        }

        return '';
    }

    public function isEmpty(): bool
    {
        return $this->numberOfBikesAvailable() === 0;
    }

    public function isNearlyEmpty(): bool
    {
        return $this->numberOfBikesAvailable() < 3;
    }
}
