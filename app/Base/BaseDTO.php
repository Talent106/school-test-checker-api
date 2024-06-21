<?php

namespace App\Base;

use Illuminate\Support\Collection;

abstract class BaseDTO
{
    public static function createFromMany(Collection|array $data): Collection
    {
        $datum = is_array($data) ? Collection::make($data) : $data;

        return $data->map(fn ($item) => static::createFromCollection($item));
    }

    abstract public static function createFromCollection(Collection $data): self;

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toCollection(): Collection
    {
        return Collection::make($this->toArray());
    }

    public function except(array $keys): Collection
    {
        return $this->toCollection()->except($keys);
    }

    public function only(array $keys): Collection
    {
        return $this->toCollection()->only($keys);
    }
}
